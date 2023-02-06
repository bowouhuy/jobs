<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title'=> 'Customer',
        );

        return view('admin.customer.index', $data);
    }

    public function list(){
       $user = User::where('role','=','1')->get();
        // $data = array();

        return DataTables::of($user)
        // ->addColumn('action', function($row){
        //     return back;
        // })
        ->toJson();

    }

    

    

}
