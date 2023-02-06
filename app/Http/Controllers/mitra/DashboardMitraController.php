<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Jasa;

class DashboardMitraController extends Controller
{
    public function index() {
        // $curr_year = date('Y');
        // $curr_month = date('m');
        // $recent_month = date('m', strtotime("-1 Month", strtotime(date('Y-m'))));
        // $stats = array(
        //     'recent_total_orders' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$recent_month)->get()->count(),
        //     'recent_total_revenue' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$recent_month)->sum('amount'),
        //     'recent_total_average' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$recent_month)->get()->count()/Transaksi::sum('amount'),
        //     'recent_total_jasa' => Jasa::whereYear('created_at',$curr_year)->whereMonth('created_at',$recent_month)->get()->count(),
        //     'curr_total_orders' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$curr_month)->get()->count(),
        //     'curr_total_revenue' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$curr_month)->sum('amount'),
        //     'curr_total_average' => Transaksi::whereYear('tanggal_invoice',$curr_year)->whereMonth('tanggal_invoice',$curr_month)->get()->count()/Transaksi::sum('amount'),
        //     'curr_total_jasa' => Jasa::whereYear('created_at',$curr_year)->whereMonth('created_at',$curr_month)->get()->count(),
        //     'total_transaksi' => Transaksi::get()->count(),
        //     'total_income' => Transaksi::sum('amount'),
        // );
        
        // // print_r($stats);exit;
        // $data = array(
        //     'title'=> 'Dashboard',
        //     'stats'=> $stats
        // );

        // return view('admin.dashboard.index', $data);
        return redirect('mitra/jasa');
    }
}
