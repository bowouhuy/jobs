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
        $jasa = Jasa::all();
        $res = array();
        foreach ($jasa as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $res[$key] = $item;
            if ($jasa_image){
                $res[$key]['image'] = $jasa_image->url;
            }
        }

        $mitra = DB::select('SELECT a.id AS user_id, a.first_name, a.last_name, b.total, c.* FROM users a
                    INNER JOIN (
                    SELECT mitra_id, jasa_id, COUNT(*) AS total FROM transaksi 
                    GROUP BY mitra_id, jasa_id
                    )b ON a.id = b.mitra_id
                    INNER JOIN jasa c ON b.jasa_id = c.id
                    ORDER BY b.total DESC
                    LIMIT 4
                ');
        $res_mitra = array();
        foreach ($mitra as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $res_mitra[$key] = $item;
            if ($jasa_image){
                $res_mitra[$key]->image = $jasa_image->url;
            }
        }

        foreach ($mitra as $key => $item) {
            $user_image = Userimages::where('user_id', $item->user_id)->take(1)->first();
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
        $transaksi = DB::table('transaksi')
                    ->join('jasa', 'transaksi.jasa_id', '=', 'jasa.id')
                    ->join('paket', 'transaksi.paket_id', '=', 'paket.id')
                    ->select('transaksi.*', 'jasa.nama as nama_jasa', 'paket.nama as nama_paket')
                    ->where('transaksi.customer_id','=', Auth::user()->id)
                    ->get();
        $data = array(
            'title'=> 'Profile',
            'menu' => $this->menu,
            // 'image' => $user_image->url,
            'transaksi' => $transaksi
        );
        return view('user.home.profile', $data);
    }
}
