<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title'=> 'Mitra',
        );

        return view('admin.mitra.index', $data);
    }

    public function list(){
    //    $user = User::where('role','=','2')->get();
        $user = DB::table('users')
                ->leftJoin('user_images','users.id','=','user_images.user_id')
                ->where('role','=','2')
                ->select('users.*','user_images.filename')
                ->get();
        return DataTables::of($user)
        ->addColumn('status', function($row){
            if ($row->user_st == 1){
                return '<span class="badge badge-success">Aktif</span>';
            } else {
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            }
        })
        ->addColumn('action', function($row){
            return '
            <button onclick=verifikasi_user("'.asset('images/user_image/').'/'.$row->filename.'",'.$row->id.') data-toggle="modal" data-target="#imageModal" class="btn btn-sm btn-primary"><b><i class="fa fa-check mr-1"></i>Verifikasi</b></button>
            ';
        })
        ->rawColumns(['status','action'])
        ->toJson();
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');

        $user = User::find($user_id);
        $user->user_st = '1';
        
        if ($user->save()){
            return redirect('admin/mitra');
        }
    }

    

    

}
