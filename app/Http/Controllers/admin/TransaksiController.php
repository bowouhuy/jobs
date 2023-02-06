<?php

namespace App\Http\Controllers\admin;

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
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = array(
            'title'=> 'Transaksi',
        );

        return view('admin.transaksi.index', $data);
    }

    public function list() {
        // $transaksi = DB::table('transaksi')
        //             ->join('jasa','transaksi.jasa_id','=','jasa.id')
        //             ->select('transaksi.*','jasa.nama AS nama_jasa','jasa.mitra_id')
        //             ->get();
        $transaksi = Transaksi::with('jasa')->get();
        $data = array();
        foreach ($transaksi as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->jasa_id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image){
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($transaksi as $key => $item) {
            $mitra = User::where('id', $item->jasa->mitra_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra){
                $data[$key]['nama_mitra'] = $mitra->first_name.' '.$mitra->last_name;
            }
        }
        $data2 = json_encode($data);
        dd($data2);
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
                <button onclick=confirm_transaksi("'.asset('images/invoice/').'/'.$row->bukti_transaksi.'",'.$row->id.') 
                class="btn btn-sm btn-success mr-1"><b><i class="fa fa-check mr-1"></i>
                Confirm
                </b></a>
                </div>
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

    public function edit($id)
    {
        //
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

    public function export()
	{
		return Excel::download(new TransaksiExport, 'transaksi.xlsx');
	}
}
