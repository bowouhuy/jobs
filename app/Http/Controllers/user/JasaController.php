<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\Paket;
use App\Models\Transaksi;

class JasaController extends Controller
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

    public function index($subkategori_id,Request $request) {
        $jasa = Jasa::when($subkategori_id,function($query,$subkategori_id) {
                return $query->where('subkategori_id', $subkategori_id);
                })->when($request, function($query, $request){
                return $query->where('nama','LIKE','%'.$request->input('search').'%');
                })->get();
        $res = array();
        foreach ($jasa as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $res[$key] = $item;
            if ($jasa_image){
                $res[$key]['image'] = $jasa_image->url;
            }
        }
        
        $data = array(
            'title'=> 'List Jasa',
            'menu' => $this->menu,
            'jasa' => $res,
            'subkategori_id' => $subkategori_id
        );
        return view('user.jasa.index', $data);
    }

    public function show($jasa_id) {
        $jasa = Jasa::find($jasa_id);
        $carousel_images = Jasaimage::where('jasa_id', $jasa_id)->skip(0)->take(4)->get();
        $more_images = Jasaimage::where('jasa_id', $jasa_id)->skip(4)->take(6)->get();
        $paket = Paket::where('jasa_id', $jasa_id)->get();

        $data = array(
            'title'=> 'Detail Jasa',
            'menu' => $this->menu,
            'jasa' => $jasa,
            'carousel_images' => $carousel_images,
            'more_images' => $more_images,
            'paket' => $paket
        );

        return view('user.jasa.detail', $data);
    }

}
