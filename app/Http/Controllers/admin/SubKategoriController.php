<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subkategori as subKategori;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title'=> 'Sub Kategori',
        );

        $tes  =  Subkategori::all();

        return view('admin.subkategori.index', $data);
    }


    public function list(){
        $subKategori = subKategori::with(['kategori'])->get();
   
      
         // $data = array();
 
         return DataTables::of($subKategori)
         ->addColumn('action', function($row){
             return '
             <a href="subkategori/edit/'.$row->id.'" class="btn btn-sm btn-warning"><b><i class="fa fa-pencil mr-1"></i>Edit</b></a>
             <button onclick="delete_subkategori('.$row->id.')" class="btn btn-sm btn-danger"><b><i class="fa fa-trash mr-1"></i>Delete</b></button>
             ';
         })
         ->toJson();
 
     }

     public function delete_subkategori($subkategori_id){
        $kategori = subKategori::find($subkategori_id);
      

        if($kategori->delete()){
            return redirect('admin/subkategori');
        }
    }

    public function create()
    {
        $kategori = Kategori::all();
        $data = array(
            'title'=> 'SubKategori',
            'kategori' => $kategori
        );
        return view ('admin.subkategori.form',$data);
    }


    public function form_subkategori_store(Request $request){    
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $kategori = SubKategori::create($request->all());
    
           
        if ($kategori->save()){
            return redirect('admin/subkategori',);
        }else{
            return back();
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'title'=> 'SubKategori',
        );
        $subkategori = subKategori::find($id);


        
        return view('admin.subkategori.edit',compact('subkategori'),$data);
    }

    public function update(Request $request,$id){
        $subKategori = subKategori::find($id);
        $subKategori->update($request->all());
        return redirect('admin/subkategori')->with(['success' => 'Berhasil merubah data']);
    }

  

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
