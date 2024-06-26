<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Transaksi;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\User;
use App\Models\Orderfile;
use App\Models\Kategori;
use App\Models\Order;

class TransaksiController extends Controller
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
    public function list()
    {
        // $transaksi = DB::table('transaksi')
        //             ->join('jasa','transaksi.jasa_id','=','jasa.id')
        //             ->select('transaksi.*','jasa.nama AS nama_jasa','jasa.mitra_id')
        //             ->get();
        $transaksi = Transaksi::with('jasa')->where('customer_id', '=', Auth::user()->id)->get();
        $data = array();
        foreach ($transaksi as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->jasa_id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image) {
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($transaksi as $key => $item) {
            $mitra = User::where('id', $item->jasa->mitra_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra) {
                $data[$key]['nama_mitra'] = $mitra->first_name . ' ' . $mitra->last_name;
            }
        }
        return DataTables::of($data)
            ->addColumn('jasa_image', function ($row) {
                if ($row->image) {
                    return '<img src="' . public_path('images/jasa_image/') . $row->image . '" class="img-fluid">';
                } else {
                    return 'No Images';
                }
            })
            ->addColumn('status_transaksi', function ($row) {
                if ($row->status == 'waiting') {
                    return '<div class="text-center"><span class="badge badge-warning">Waiting</span></div>';
                } else {
                    return '<div class="text-center"><span class="badge badge-success">Confirmed</span></div>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center">
                <button onclick=confirm_transaksi("' . asset('images/invoice/') . '/' . $row->bukti_transaksi . '",' . $row->id . ') 
                class="btn btn-sm btn-success mr-1"><b><i class="fa fa-check mr-1"></i>
                View
                </b></a>
                </div>
                ';
            })
            ->rawColumns(['jasa_image', 'status_transaksi', 'action'])
            ->toJson();
    }

    public function listorder()
    {
        // $transaksi = DB::table('transaksi')
        //             ->join('jasa','transaksi.jasa_id','=','jasa.id')
        //             ->select('transaksi.*','jasa.nama AS nama_jasa','jasa.mitra_id')
        //             ->get();
        $transaksi = Transaksi::with('jasa', 'mitra')->where('customer_id', '=', Auth::user()->id)->get();
        $data = array();
        foreach ($transaksi as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->jasa_id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image) {
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($transaksi as $key => $item) {
            $mitra = User::where('id', $item->customer_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra) {
                $data[$key]['nama_customer'] = $mitra->first_name . ' ' . $mitra->last_name;
            }
        }
        // dd($data);
        return DataTables::of($data)
            ->addColumn('jasa_image', function ($row) {
                if ($row->image) {
                    return '<img src="' . public_path('images/jasa_image/') . $row->image . '" class="img-fluid">';
                } else {
                    return 'No Images';
                }
            })
            ->addColumn('status_transaksi', function ($row) {
                if ($row->status == 'waiting') {
                    return '<div class="text-center"><span class="badge badge-warning">Waiting</span></div>';
                } else {
                    return '<div class="text-center"><span class="badge badge-success">Confirmed</span></div>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center">
                <form action="profile/order/download">
                <input name="row_id" id="row_id" type="hidden" value="' . $row->id . '">
                <button class="btn btn-primary waves-effect waves-light upload">Download Order</button>
                </form>
                </b></a>
                
                ';
            })
            ->rawColumns(['jasa_image', 'status_transaksi', 'action'])
            ->toJson();
    }

    public function getDownload(request $request)
    {
        //PDF file is stored under project/public/download/info.pdf
        $orderfile = Orderfile::where('transaksi_id', $request->row_id)->take(1)->first();
        $filename = $orderfile->filename;
        $file = public_path() . "/orderfile/" . $filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $filename, $headers);
    }

    public function formCreate($paket_id)
    {
        $paket = Paket::with('jasa.jasaimages')->where('id', $paket_id)->first();

        $data = array(
            'title' => 'Form Order',
            'menu' => $this->menu,
            'jasa' => $paket->jasa,
            'paket' => $paket,
        );

        return view('user.transaksi.create', $data);
    }

    public function formConfirm(Request $request){
        $customer = Auth::user();
        $jasa = Paket::with('jasa.jasaimages')->where('id', $request->paket_id)->first();
        $mitra = User::where('id', $jasa->jasa->mitra_id)->take(1)->first();
        $paket = Paket::find($request->paket_id);
        $data = array(
            'title' => 'Form Order',
            'menu' => $this->menu,
            'jasa' => $jasa,
            'customer' => $customer,
            'mitra' => $mitra,
            'paket' => $paket,
        );
        return view('user.invoice.index', $data);
    }

    public function payment(Request $request){
        $id = $request->order_id;
        $order = Order::with('transaksi')->find($id);
        $jasa = Jasa::find($order->jasa_id);
        $customer = User::where('id', $order->customer_id)->take(1)->first();
        $mitra = User::where('id', $order->mitra_id)->take(1)->first();
        $paket = Paket::find($order->paket_id);

        $data = array(
            'title' => 'Payment',
            'menu' => $this->menu,
            'jasa' => $jasa,
            'customer' => $customer,
            'mitra' => $mitra,
            'paket' => $paket,
            'order' => $order,
        );

        return view('user.invoice.payment', $data);
    }
    

}
