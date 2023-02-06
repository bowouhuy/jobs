<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\Paket;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title'=> 'Kategori',
        );

        return view('admin.kategori.index', $data);
    }

    public function list(){
       $kategori = Kategori::all();
        // $data = array();

        return DataTables::of($kategori)
        ->addColumn('action', function($row){
            return '
            <a href="kategori/edit/'.$row->id.'" class="btn btn-sm btn-warning"><b><i class="fa fa-pencil mr-1"></i>Edit</b></a>
            <button onclick="delete_kategori('.$row->id.')" class="btn btn-sm btn-danger"><b><i class="fa fa-trash mr-1"></i>Delete</b></button>
            ';
        })
        ->toJson();

    }

    



    public function form_kategori_store(Request $request){    
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $kategori = Kategori::create($request->all());
    
           
        if ($kategori->save()){
            return redirect('admin/kategori');
        }else{
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function delete_kategori($kategori_id){
        $kategori = Kategori::find($kategori_id);
      

        if($kategori->delete()){
            return redirect('admin/kategori');
        }
    }

    public function create()
    {
        $data = array(
            'title'=> 'Kategori',
        );

        return view ('admin.kategori.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'title'=> 'Kategori',
        );

        $kategori = Kategori::find($id);

        
        return view('admin.kategori.edit',compact('kategori'),$data);
    }

    public function update(Request $request,$id){
        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        return redirect('admin/kategori')->with(['success' => 'Berhasil merubah data']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
