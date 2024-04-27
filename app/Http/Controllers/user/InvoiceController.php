<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Jasa;
use App\Models\User;
use App\Models\Jasaimage;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    private $menu;

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

    public function index($paket_id){
        $paket = Paket::find($paket_id);
        $jasa = Jasa::find($paket->jasa_id);
        $mitra = User::where('id', $jasa->mitra_id)->take(1)->first();

        $data = array(
            'title'=> 'Invoice',
            'menu' => $this->menu,
            'paket' => $paket,
            'jasa' => $jasa,
            'mitra' => $mitra,
            'customer' => Auth::user()
        );

        return view('user.invoice.index', $data);
    }

    public function show($transaksi_id){
        $transaksi = Transaksi::find($transaksi_id);
        $paket = Paket::find($transaksi->paket_id);
        $jasa = Jasa::find($paket->jasa_id);
        $mitra = User::where('id', $jasa->mitra_id)->take(1)->first();

        $data = array(
            'title'=> 'Invoice',
            'menu' => $this->menu,
            'paket' => $paket,
            'jasa' => $jasa,
            'mitra' => $mitra,
            'transaksi' => $transaksi
        );

        return view('user.invoice.index', $data);
    }

    // public function store(Request $request){
    //     $paket_id = $request->file('paket_id');
    //     $image = $request->file('file');

    //     $paket = Paket::find($paket_id);
    //     $jasa = Jasa::find($paket->jasa_id);
    //     $mitra = Jasa::find($jasa->mitra_id)->mitra;
    //     $transaksi = Transaksi::create([
    //         'customer_id' => 1,
    //         'jasa_id' => $jasa->id,
    //         'paket_id' => $paket_id,
    //         'amount' => $paket->harga+($paket->harga*0.10),
    //         'kode_invoice' => date('YmdHis'),
    //         'tanggal_invoice' => date('Y-m-d'),
    //         'tanggal_expired' => date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d'))))
    //     ]);
        
    //     if ($transaksi->save()){
    //         return view('user.invoice.index');
    //     }
    // }

    public function store(Request $request){
        // $image = $request->file('file');
        $paket_id = $request->input('paket_id');
        // $deskripsi = $request->input('deskripsi');

        
        /** Upload Images */
        // $filename = $image->getClientOriginalName();
        // $image->move(public_path('images/invoice'),$filename);
        
        $paket = Paket::find($paket_id);
        $jasa = Jasa::find($paket->jasa_id);
        $transaksi = Transaksi::create([
            'customer_id' => Auth::user()->id,
            'mitra_id' => $jasa->mitra_id,
            'jasa_id' => $jasa->id,
            'paket_id' => $paket_id,
            'amount' => $paket->harga+($paket->harga*0.10),
            // 'deskripsi' => $deskripsi,
            'kode_invoice' => date('YmdHis'),
            'tanggal_invoice' => date('Y-m-d'),
            'tanggal_expired' => date('Y-m-d', strtotime('+'.$paket->estimasi.' days', strtotime(date('Y-m-d')))),
            'tanggal_transaksi' => date('Y-m-d'),
            'bukti_transaksi' => "test"
        ]);
        if ($transaksi->save()){
            $data = array(
                'user'=> Auth::user(),
                'transaction' => $transaksi
            );
            $snap = $this->getSnapToken($data);
            $url = "https://app.sandbox.midtrans.com/snap/v2/vtweb/".$snap;
            // return Redirect::to($url);
            return response()->json(['snap'=> $snap]);
            // return response()->json(['transaction'=> $transaksi, 'user'=> Auth::user()]);
        }
    }

    public function delete_files($filename){
        if(File::exists(public_path('images/invoice/'. $filename))){
            File::delete(public_path('images/invoice/'. $filename));
            /*
                Delete Multiple File like this way
                File::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    public function getSnapToken($data){

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
                'order_id' => rand(),
                'gross_amount' => $data['transaction']->amount,
            ),
            'customer_details' => array(
                'first_name' => $data['transaction']->first_name,
                'last_name' => $data['transaction']->last_name,
                'email' => $data['transaction']->email,
                'phone' => $data['transaction']->no_hp
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }

    public function paymentNotification(Request $request){
        $order_id = $request->input('order_id');

        $data = Invoice::where('order_id', $order_id)->first();

        $data->transaksi_st = $request->input('transaction_status');
        $data->transaksi_detail = $request->input();
        $data->transaksi_tanggal = date("Y-m-d");

        $data->save();

        return response()->json(['message' => $order_id], 200);

    }
}
