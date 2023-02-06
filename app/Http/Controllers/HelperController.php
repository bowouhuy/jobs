<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\Kategori;
use App\Models\Paket;
use Illuminate\Support\Facades\File;

class HelperController extends Controller
{
    public function get_subkategori($kategori_id, $subkategori_id = ''){
        $subkategori = Kategori::find($kategori_id)->subkategori;
        $html = '<option value="">Pilih Sub Kategori</option>';
        foreach ($subkategori as $value) {
            $select = '';
            if ($value->id == $subkategori_id){
                $select = 'selected="selected"';
            }
            $html .= '<option value="'.$value->id.'" '.$select.'>'.$value->nama.'</option>';
        }

        echo $html;
    }

    public function get_paket($paket_id){
        $paket = Paket::find($paket_id);

        return response()->json($paket);
    }

    public function get_jasa_images($jasa_id){
        $jasa_image = Jasaimage::where('jasa_id', $jasa_id)->get();
        $images = array();
        foreach($jasa_image as $item){
            $obj['name'] = $item->filename;
            $obj['size'] = File::size(public_path('images/jasa_image/'. $item->filename));
            $images[] = $obj;
        }

        return response()->json($images);
    }
}
