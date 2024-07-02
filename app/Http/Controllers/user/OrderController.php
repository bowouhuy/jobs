<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\OrderHistory;
use App\Traits\HelperTrait;

class OrderController extends Controller
{
    use HelperTrait;
    public function __construct() {
        $kategori = Kategori::all();
        $this->menu = array();
        foreach ($kategori as $key => $data) {
            $subkategori = Kategori::find($data->id)->subkategori;
            $this->menu[$key] = $data;
            if ($subkategori){
                $this->menu[$key]['subkategori'] = $subkategori;
            }
        }
    }
    public function createTransaction($data){

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-QjP-rzzNBfBl0vyfnenRBH9x';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $data['order']->order_id,
                'gross_amount' => $data['amount']
            ),
            'customer_details' => array(
                'first_name' => $data['user']->first_name,
                'last_name' => $data['user']->last_name,
                'email' => $data['user']->email,
                'phone' => $data['user']->no_hp
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }
    public function store(Request $request)
    {
        $customer_id = Auth::user()->id;
        $paket = Paket::with('jasa.mitra')->find($request->paket_id);

        if($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('order/attachment/', $filename);
            $request->attachment = $filename;
        }
        //generate order id
        $order_id = 'ORD-' . time();
        $order = new Order();
        $order->transaksi_id = $request->transaksi_id;
        $order->order_id = $order_id;
        $order->status = 1;
        $order->jasa_id = $request->jasa_id;
        $order->paket_id = $request->paket_id;
        $order->customer_id = $customer_id;
        $order->mitra_id = $paket->jasa->mitra_id;
        $order->attachment = $request->attachment;
        $order->description = $request->description;
        $order->save();

        $amount = $paket->harga + ($paket->harga * 0.1); //10% tax
        if ($order->save()){
            OrderHistory::create([
                'order_id' => $order->id,
                'status' => 1
            ]);
            //generate invoice id
            $invoice_id = 'INV-' . time();
            $data = array(
                'user'=> Auth::user(),
                'order' => $order,
                'amount' => $amount,
                'invoice_id' => $invoice_id
            );
            $snap = $this->createTransaction($data);
            $transaksi = new Transaksi();
            $transaksi->kode_invoice = $invoice_id;
            $transaksi->order_id = $order->id;
            $transaksi->amount = $amount;
            $transaksi->snap_code = $snap;
            $transaksi->save();

            TransactionHistory::create([
                'transaksi_id' => $transaksi->id,
                'status' => 1
            ]);

            $order->transaksi_id = $transaksi->id;
            $order->save();
        }

        return redirect()->route('user.transaksi.payment', ['order_id' => $order->id]);
    }

    public function detail($id)
    {
        $order = Order::with('paket.jasa.mitra')->find($id);
        $mergeHistory = self::orderHistory($id);
        $data = array(
            'title' => 'Order Detail',
            'menu' => $this->menu,
            'order' => $order,
            'mergeHistory' => $mergeHistory
        );

        return view('user.order.detail', $data);
    }
}
