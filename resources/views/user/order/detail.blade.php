@extends('user.layouts.main')

@section('body')
    <div style="background: -webkit-gradient(linear, left top, right top, from(#7f59dc), to(#655be6)); background: linear-gradient(to right, #7f59dc, #655be6); height: 120px; width: 100%; ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <h4 class="page-title mb-0 mt-0">{{$title}}</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-title p-3 mb-0">
                                    <h5 class="card-title">Detail Pemesanan #{{$order->order_id}}</h5>
                                </div>
                                <div class="card-body p-3">
                                    <h4 class="header-title">{{$order->jasa->nama}}</h4>
                                    <h5 class="header-title">{{$order->paket->nama}}</h5>
                                    <p class="card-text">{{$order->paket->deskripsi}}</p>
                                    <p class="card-text">Rp. {{number_format($order->paket->harga)}}</p>
                                    <img style="height:400px" class="d-block mx-auto img-fluid" src="{{asset('images/jasa_image/'.$order->paket->jasa->jasaimages[0]->url)}}" alt="{{$order->paket->jasa->jasaimages[0]->filename}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-title p-3 mb-0">
                                    <h5 class="card-title">Riwayat Pesanan</h5>
                                </div>
                                <div class="card-body p-3">
                                    <table class="table">
                                        <tbody>
                                            @foreach($mergeHistory as $history)
                                                <tr>
                                                    <td>{{$history['date']}}</td>
                                                    <td>{{$history['status']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_template/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_template/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin_template/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
    <script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>

@endsection