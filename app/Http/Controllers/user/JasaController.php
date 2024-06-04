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

    public function index(Request $request, $subkategori_id = null) {
        $jasa = Jasa::where('nama','LIKE','%'.$request->input('search').'%');
        if ($subkategori_id !== null) {
            $jasa->where('subkategori_id', $subkategori_id);
        }
            $jasa = $jasa->get();
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
            'jasa' => $res
        );
        return view('user.jasa.index', $data);
    }

    public function show($jasa_id) {
        $jasa = Jasa::find($jasa_id);
        $carousel_images = Jasaimage::where('jasa_id', $jasa_id)->get();
        $more_images = Jasaimage::where('jasa_id', $jasa_id)->get();
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
