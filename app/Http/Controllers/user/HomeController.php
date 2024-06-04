<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\Userimages;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class HomeController extends Controller
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

    public function index() {
        $jasa = Jasa::orderBy('created_at', 'desc')->get();
        $res = array();
        foreach ($jasa as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $res[$key] = $item;
            if ($jasa_image){
                $res[$key]['image'] = $jasa_image->url;
            }
        }

        // top 4 mitra highest count orders
        $mitra = DB::table('orders')
                    ->join('jasa', 'orders.jasa_id', '=', 'jasa.id')
                    ->join('users', 'jasa.mitra_id', '=', 'users.id')
                    ->select('users.*', DB::raw('count(orders.id) as total'))
                    ->groupBy('jasa.mitra_id')
                    ->orderBy('total', 'desc')
                    ->take(4)
                    ->get();
//        dd($mitra);
        $res_mitra = array();
        foreach ($mitra as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $res_mitra[$key] = $item;
            if ($jasa_image){
                $res_mitra[$key]->image = $jasa_image->url;
            }
        }

        foreach ($mitra as $key => $item) {
            $user_image = Userimages::where('user_id', $item->id)->take(1)->first();
            $res_mitra[$key] = $item;
            if ($user_image){
                $res_mitra[$key]->user_image = $user_image->filename;
            }
        }
        
        $data = array(
            'title'=> 'Dashboard',
            'menu' => $this->menu,
            'jasa' => $res,
            'mitra' => $res_mitra
        );

        return view('user.home.index', $data);
    }

    public function profile() {
        $user_image = Userimages::where('user_id', Auth::user()->id)->take(1)->first();
        $orders = Order::with('transaksi', 'jasa.paket')->where('customer_id', Auth::user()->id)->get();
//        dd($orders);
        $data = array(
            'title'=> 'Profile',
            'menu' => $this->menu,
            // 'image' => $user_image->url,
            'orders' => $orders
        );
        return view('user.home.profile', $data);
    }
}
