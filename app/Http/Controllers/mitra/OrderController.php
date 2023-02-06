<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Jasa;
use App\Models\Jasaimage;
use App\Models\User;
use App\Models\Orderfile;

class OrderController extends Controller
{
    public function index()
    {
        $data = array(
            'title'=> 'Transaksi',
        );

        return view('mitra.order.index', $data);
    }

    public function list() {
        // $transaksi = DB::table('transaksi')
        //             ->join('jasa','transaksi.jasa_id','=','jasa.id')
        //             ->select('transaksi.*','jasa.nama AS nama_jasa','jasa.mitra_id')
        //             ->get();
        $transaksi = Transaksi::with('jasa')->where('mitra_id','=', Auth::user()->id)->get();
        $data = array();
        foreach ($transaksi as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->jasa_id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image){
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($transaksi as $key => $item) {
            $mitra = User::where('id', $item->customer_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra){
                $data[$key]['nama_customer'] = $mitra->first_name.' '.$mitra->last_name;
            }
        }
        // dd($data);
        return DataTables::of($data)
            ->addColumn('jasa_image', function($row){
                if ($row->image){
                    return '<img src="'.public_path('images/jasa_image/').$row->image.'" class="img-fluid">';
                } else {
                    return 'No Images';
                }
            })
            ->addColumn('status_transaksi', function($row){
                if ($row->status == 'waiting'){
                    return '<div class="text-center"><span class="badge badge-warning">Waiting</span></div>';
                } else {
                    return '<div class="text-center"><span class="badge badge-success">Confirmed</span></div>';
                }
            })
            ->addColumn('action', function($row){
                return '<div class="text-center">
                <input name="row_id" id="row_id" type="hidden" value="'.$row->id.'">
                <button class="btn btn-primary waves-effect waves-light upload" data-toggle="modal" data-target="#uploadModal">Upload Order</button>
                </b></a>
                

                
                ';
            })
            ->rawColumns(['jasa_image','status_transaksi','action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $transaksi_id = $request->input('confirm_id');

        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status = 'paid';
        
        if ($transaksi->save()){
            return redirect('admin/transaksi');
        }
    }

    public function form_order_store(Request $request){        
        $transaksi_id = $request->input('transaksi_id');
        /** Upload Images */
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('orderfile'),$filename);
        // return $request;
        /** Insert Jasa Images */
        $orderfile = Orderfile::create([
            'transaksi_id' => $transaksi_id,
            'filename' => $filename,
            'url' => $filename
        ]);
        if ($orderfile->save()){
            return redirect('mitra/order/');
        }
    }

    public function delete_files($filename){
        if(File::exists(public_path('orderfile/'. $filename))){
            File::delete(public_path('orderfile/'. $filename));
            /*
                Delete Multiple File like this way
                File::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
