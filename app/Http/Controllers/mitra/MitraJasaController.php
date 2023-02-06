<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\Paket;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class MitraJasaController extends Controller
{
    public function index() {
        $data = array(
            'title'=> 'Jasa',
        );

        return view('mitra.jasa.index', $data);
    }

    public function list() {
        $jasa = Jasa::where('mitra_id','=', Auth::user()->id)->get();
        $data = array();
        foreach ($jasa as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image){
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($jasa as $key => $item) {
            $mitra = User::where('id', $item->mitra_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra){
                $data[$key]['nama_mitra'] = $mitra->first_name.' '.$mitra->last_name;
            }
        }

        return DataTables::of($data)
            ->addColumn('jasa_image', function($row){
                if ($row->image){
                    return '<img src="'.public_path('images/jasa_image/').$row->image.'" class="img-fluid">';
                } else {
                    return 'No Images';
                }
            })
            ->addColumn('action', function($row){
                return '
                <a href="jasa/form_jasa/'.$row->id.'" class="btn btn-sm btn-warning"><b><i class="fa fa-pencil mr-1"></i>Edit</b></a>
                <button onclick="delete_jasa('.$row->id.')" class="btn btn-sm btn-danger"><b><i class="fa fa-trash mr-1"></i>Delete</b></button>
                ';
            })
            ->toJson();
    }

    public function form_jasa($jasa_id = ''){
        $jasa = '';
        if ($jasa_id){
            $jasa = Jasa::find($jasa_id);
            $jasa_kategori = Subkategori::find($jasa->subkategori_id)->kategori;
            $jasa->kategori_id = $jasa_kategori->id;
        }
        $kategori = Kategori::all();

        $data = array(
            'title'=> 'Tambah Jasa',
            'kategori'=> $kategori,
            'jasa'=> $jasa
        );

        return view('mitra.jasa.form', $data);
    }

    public function form_jasa_store(Request $request){    
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'subkategori_id' => 'required',
        ]);

        $jasa_id = $request->input('jasa_id');

        if (!$jasa_id){
            /** Insert Jasa */
            $jasa = Jasa::create([
                'nama' => $request->input('nama'),
                'subkategori_id' => $request->input('subkategori_id'),
                'mitra_id' => Auth::user()->id,
                'deskripsi' => $request->input('deskripsi'),
            ]);
        } else {
            $jasa = Jasa::find($jasa_id);
            $jasa->nama = $request->input('nama');
            $jasa->subkategori_id = $request->input('subkategori_id');
            $jasa->deskripsi = $request->input('deskripsi');
        }
        
        if ($jasa->save()){
            return redirect('mitra/jasa/form_images/'.$jasa->id);
        }
    }

    public function form_images($jasa_id){
        $data = array(
            'title'=> 'Upload Images',
            'jasa_id'=> $jasa_id,
        );
        
        return view('mitra.jasa.form_images', $data);
    }

    public function form_images_store(Request $request){        
        $jasa_id = $request->input('jasa_id');
        /** Upload Images */
        $image = $request->file('file');
        $filename = $image->getClientOriginalName();
        $image->move(public_path('images/jasa_image'),$filename);
    
        /** Insert Jasa Images */
        $jasa_image = Jasaimage::create([
            'jasa_id' => $jasa_id,
            'filename' => $filename,
            'url' => $filename
        ]);
        if ($jasa_image->save()){
            return redirect('mitra/jasa/form_images/'.$jasa_id);
        }
    }

    public function form_paket($jasa_id){
        $paket = Jasa::find($jasa_id)->paket;

        $data = array(
            'title'=> 'Tambah Paket',
            'jasa_id'=> $jasa_id,
            'paket'=> $paket
        );
        
        return view('mitra.jasa.form_paket', $data);
    }

    public function form_paket_store(Request $request){     
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'estimasi' => 'required',
            'harga' => 'required',
        ]);

        $jasa_id = $request->input('jasa_id');   
        $paket_id = $request->input('paket_id');   
        /** Insert Paket */
        if (!$paket_id){
            $paket = Paket::create([
                'jasa_id' => $jasa_id,
                'nama' => $request->input('nama'),
                'deskripsi' => $request->input('deskripsi'),
                'estimasi' => $request->input('estimasi'),
                'harga' => $request->input('harga'),
            ]);
        } else {
            $paket = Paket::find($paket_id);
            $paket->nama = $request->input('nama');
            $paket->deskripsi = $request->input('deskripsi');
            $paket->estimasi = $request->input('estimasi');
            $paket->harga = $request->input('harga');
        }
        
        if ($paket->save()){
            return redirect('mitra/jasa/form_paket/'.$jasa_id);
        }
    }

    public function delete_jasa($jasa_id){
        $jasa = Jasa::find($jasa_id);
        $paket = Paket::where('jasa_id',$jasa_id);
        $jasa_image = Jasaimage::where('jasa_id',$jasa_id);
        if($jasa_image){
            $jasa_image->delete();
        }

        if($paket){
            $paket->delete();
        }

        if($jasa->delete()){
            return redirect('mitra/jasa');
        }
    }

    public function delete_paket($paket_id){
        $paket = Paket::find($paket_id);
        $jasa_id = $paket->jasa_id;
        if($paket->delete()){
            return redirect('mitra/jasa/form_paket/'.$jasa_id);
        }
    }

    public function delete_files($filename){
        $jasa_image = Jasaimage::where('filename', $filename);
        $jasa_image->delete();
        if(File::exists(public_path('images/jasa_image/'. $filename))){
            File::delete(public_path('images/jasa_image/'. $filename));
            /*
                Delete Multiple File like this way
                File::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }
}
