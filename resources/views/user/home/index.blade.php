@extends('user.layouts.main')

@section('body')
<div style="background: -webkit-gradient(linear, left top, right top, from(#7f59dc), to(#655be6)); background: linear-gradient(to right, #7f59dc, #655be6); height: 300px; width: 100%; ">
    <div class="container-fluid">
        <div class="row mx-1">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                            <h4 class="title mb-0">Talenttra</h4>
                        </div>
                    </div>
                    <div class="row align-items-center mt-5">
                        <div class="col-md-6 mx-auto">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <button class="btn btn-block btn-lg btn-light" data-toggle="modal" data-target="#kategoriModal"><i class="fa fa-search mr-2"></i> Temukan Creator</button>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <a href="{{url('/register')}}" class="btn btn-block btn-lg btn-outline-light">Daftar Sebagai Creator</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-top: -6em; padding-top: 0px">
    <div class="row mx-1">
        <div class="col-md-10 mx-auto">
            <div class="card py-2">
                <div class="card-body text-center">
                    <div class="row">
                    @foreach ($menu as $main)
                        <div class="col-lg-auto col-sm-12 my-4 mx-auto">
                            <div class="dropdown" style="cursor:pointer; text-align:center;">
                                <a class="text-secondary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="{{$main->icon}} mx-2"></i> <br>
                                    <div class="font-weight-bold px-4">{{$main->nama}}</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuLink" >
                                    @foreach ($main->subkategori as $sub)
                                    <a class="dropdown-item" href="{{url('jasa',$sub->id)}}">{{$sub->nama}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <!-- <div id="topnav">
                        <div class="navbar-custom">
                            <div id="navigation">
                                <ul class="navigation-menu">
                                    @foreach ($menu as $main)
                                    <li class="has-submenu">
                                        <a href="#" class="text-secondary" style="padding-left:0px; padding-right:0px;">
                                            <i class="{{$main->icon}} mx-2" style="font-size:25px; margin:10px"></i> <br>
                                            <div class="font-weight-bold px-4">{{$main->nama}}</div>
                                        </a>
                                        <ul class="submenu">
                                            @foreach ($main->subkategori as $sub)
                                            <li><a href="{{url('jasa',$sub->id)}}">{{$sub->nama}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row mx-1">
            <div class="col-xl-12 col-md-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="m-t-30 m-b-20">Kenapa Talenttra?</h4>
                        <h1 class="text-primary font-weight-bold">Jasa berkualitas, Harga terjangkau, Pelayanan cepat, Transaksi aman</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stats">
                            <div class="p-3 mini-stats-content">
                                <div class="media text-light">
                                    <i class="mx-3 my-auto thumb-md rounded-circle fa fa-star-o fa-3x"></i>
                                    <div class="media-body my-2">
                                        <h4 class="mt-0">Top Creators</h4>
                                        <p class="text-white-70 mb-0">Creator telah melalui seleksi dan proses verifikasi dari Talenttra</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stats">
                            <div class="p-3 mini-stats-content">
                                <div class="media text-light">
                                    <i class="mx-3 my-auto thumb-md rounded-circle fa fa-shield fa-3x"></i>
                                    <div class="media-body my-2">
                                        <h4 class="mt-0">Jaminan kerja</h4>
                                        <p class="text-white-70 mb-0">Uang Anda akan kami lindungi, dan creator akan mulai bekerja mengerjakan project Anda.</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stats">
                            <div class="p-3 mini-stats-content">
                                <div class="media text-light">
                                    <i class="mx-3 my-auto thumb-md rounded-circle fa fa-th-list fa-3x"></i>
                                    <div class="media-body my-2">
                                        <h4 class="mt-0">Berbagai pilihan layanan</h4>
                                        <p class="text-white-70 mb-0">Pilihan layanan dengan lebih dari 2 creators tersedia dalam 17 kategori.</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1">
            <div class="col-xl-12 col-md-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="m-t-30 m-b-20">Creator Populer</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach ($mitra as $data)
                    <div class="col-md-3">
                        <div class="card">
                            <a href="{{url('jasa/detail',$data->id)}}">
                                <div class="card-header">
                                    @if (isset($data->user_image))
                                    <img src="{{asset('images/user_image/'.$data->user_image)}}" height="40px" alt="user" class="rounded-circle mb-1">
                                    @else
                                    <img src="{{ asset('user_template/assets/images/users/avatar-6.jpg') }}" height="40px" alt="user" class="rounded-circle mb-1">
                                    @endif
                                    <span class="d-md-inline-block ml-2">
                                    <h6 class="card-title font-10 my-0">{{$data->first_name}} {{$data->last_name}}</h6>
                                    <small class="text-muted my-0">Total {{$data->total}} jasa digunakan</small>
                                    </span>
                                </div>
                                @if ($data->image)
                                <img class="card-img-top img-fluid" style="height: 200px;" src="{{asset('images/jasa_image/'.$data->image)}}" alt="Card image cap">
                                @else
                                <img class="card-img-top img-fluid" height="200px" src="user_template/assets/images/small/img-4.jpg" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title font-10 mt-0">{{$data->nama}} </h6>
                                    <!-- <p class="card-text">{!! Str::limit($data->deskripsi), 50, $end='...' !!}</p> -->
                                    <p class="card-text">
                                        <small class="text-muted">Last updated {{$data->created_at}}</small>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mx-1">
            <div class="col-xl-12 col-md-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="m-t-30 m-b-20">Jasa Populer</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach ($jasa as $data)
                    <div class="col-md-3">
                        <div class="card">
                            <a href="{{url('jasa/detail',$data->id)}}">
                                @if ($data->image)
                                <img class="card-img-top img-fluid" style="height: 200px;" src="{{asset('images/jasa_image/'.$data->image)}}" alt="Card image cap">
                                @else
                                <img class="card-img-top img-fluid" height="200px" src="user_template/assets/images/small/img-4.jpg" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title font-10 mt-0">{{$data->nama}} </h6>
                                    <!-- <p class="card-text">{!! Str::limit($data->deskripsi), 50, $end='...' !!}</p> -->
                                    <p class="card-text">
                                        <small class="text-muted">Last updated {{$data->created_at}}</small>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mx-1">
            <div class="col-xl-12 col-md-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="m-t-30 m-b-20">Langkah mudah dalam menggunakan jasa Talenttra</h4>
                        <div class="card m-b-20">
                            <div class="card-body">
                                <section id="cd-timeline" class="cd-container">
                                    <div class="cd-timeline-block timeline-right">
                                        <div class="cd-timeline-img bg-success">
                                            <i class="mdi mdi-adjust"></i>
                                        </div>

                                        <div class="cd-timeline-content text-white mx-0">
                                            <h3>Mendaftarkan diri dan mengelola data profil</h3>
                                            <span class="cd-date">STEP 1</span>
                                        </div>
                                    </div>
                                    <div class="cd-timeline-block timeline-left">
                                        <div class="cd-timeline-img bg-info">
                                            <i class="mdi mdi-adjust"></i>
                                        </div>

                                        <div class="cd-timeline-content text-white">
                                            <h3>Mencari creator</h3>
                                            <span class="cd-date">STEP 2</span>
                                        </div>
                                    </div>
                                    <div class="cd-timeline-block timeline-right">
                                        <div class="cd-timeline-img bg-primary">
                                            <i class="mdi mdi-adjust"></i>
                                        </div>

                                        <div class="cd-timeline-content text-white">
                                            <h3>Berdiskusi dengan creator</h3>
                                            <span class="cd-date">STEP 3</span>
                                        </div>
                                    </div>
                                    <div class="cd-timeline-block timeline-left">
                                        <div class="cd-timeline-img bg-warning">
                                            <i class="mdi mdi-adjust"></i>
                                        </div>

                                        <div class="cd-timeline-content text-white">
                                            <h3>Transaksi</h3>
                                            <span class="cd-date">STEP 4</span>
                                        </div>
                                    </div>
                                    <div class="cd-timeline-block timeline-right">
                                        <div class="cd-timeline-img bg-danger">
                                            <i class="mdi mdi-adjust"></i>
                                        </div>

                                        <div class="cd-timeline-content text-white">
                                            <h3>Persetujuan</h3>
                                            <span class="cd-date">STEP 5</span>
                                        </div>
                                    </div>
                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-content last text-white">
                                            <h3>Kritik dan saran</h3>
                                            <span class="cd-date">STEP 6</span>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1">
            <div class="col-xl-12 col-md-12">
                <div class="row mb-5 mt-3">
                    <div class="col-md-12">
                        <h4 class="text-center font-weight-bold">FAQ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" data-toggle="modal" data-target="#modal1">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Ketentuan penggunaan Talenttra </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" data-toggle="modal" data-target="#modal2">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Kontrak umum </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal3">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Creator </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal4">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Kerja </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal5">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Penarikan pendapatan </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal6">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Pemberi kerja </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal7">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Pembelian</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal8">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Pesanan</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal17">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Status pesanan: Creator mulai bekerja</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal10">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Review dan nilai</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal11">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Permintaan pembatalan dan pembatalan pesanan/order </h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal12">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Pengembalian pembayaran</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal14">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Penggunaan yang tidak semestinya</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal15">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Kepemilikan kerja</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal16">
                                    <div class="card" height="350px">
                                        <div class="p-3 card-body">
                                            <div class="media text-secondary">
                                                <div class="media-body my-auto">
                                                    <h5 class="my-auto">Garansi</h5>
                                                </div>
                                                <i class="mx-3 my-auto fa fa-angle-right fa-2x"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Creator kategori apa yang Anda cari?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mx-5">
                @foreach ($menu as $main)
                    <div class="col-md-6">
                        <div class="dropdown" class="card border" height="350px" style="cursor:pointer; text-align:center;">
                            <div class="card border" height="350px" id="dropdownMenuModal" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="p-3 card-body">
                                    <div class="media text-secondary">
                                        <i class="mx-3 my-auto thumb-md rounded-circle {{$main->icon}} fa-3x"></i>
                                        <div class="media-body my-auto">
                                            <h5 class="my-auto">{{$main->nama}}</h5>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuModal" >
                                @foreach ($main->subkategori as $sub)
                                <a class="dropdown-item" href="{{url('jasa',$sub->id)}}">{{$sub->nama}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ketentuan penggunaan Talenttra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                Kontrak berikut adalah kontrak penggunaan antara Anda dan situs Talenttra yang mencakup informasi, 
                pembayaran, dan semua layanan yang ada didalam situs Talenttra yang harus Anda ikuti. 
                Dengan mendaftarkan akun pengguna berarti Anda setuju dan mengikuti perjanjian. 
                Termasuk, setuju pada kebijakan privasi tertulis kami. Anda tidak dapat menggunakan situs kami 
                jika Anda tidak menyetujui kontrak atau kebijakan privasi yang disebutkan di atas. 
                Anda dapat menghubungi kami melalui Layanan Konsumen jika ada pertanyaan mengenai kontrak penggunaan kami. 
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kontrak umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li> untuk membeli dan menjual di website Talenttra anda harus menjadi member </li>
                    <li> Tidak ada biaya untuk mendaftar menjadi anggota/member Talenttra </li>
                    <li> sebelum melakukan pemesanan, Pemberi kerja harus melakukan pembayaran ke Talenttra </li>
                    <li> Pemberi kerja dapat melakukan pembayaran untuk melakukan order dengan mengeklik Pilih metode pembayaran di halaman Rincian pekerjaan creator. </li>
                    <li> creator harus menyerahkan pekerjaan akhir yang telah selesai sesuai order yang diberikan. </li>
                    <li> creator tidak bisa membatalkan pesanan kecuali hanya untuk kasus khusus. </li>
                    <li> Pembatalan pesanan oleh creator akan mempengaruhi status dan review yang diberikan kepada creator. </li>
                    <li> Pengguna tidak dapat melakukan pembayaran atau menerima pembayaran melalui saluran lain selain Talenttra saja. </li>
                    <li> Pemberi kerja sepenuhnya berhak atas pekerjaan yang diajukan kecuali ada yang tertulis oleh seorang creator bahwa hak atas pekerjaan tersebut adalah milik creator di halaman detail pekerjaan. </li>
                    <li> Talenttra berhak mengambil pekerjaan yang diserahkan di Talenttra untuk digunakan untuk tujuan periklanan, termasuk pemasaran Talenttra </li>
                    <li> Kami memprioritaskan keamanan informasi anda. Anda bisa membaca kebijakan privasi yang juga termasuk dalam kontrak penggunaan. </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Creator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Untuk setiap order yang telah Anda serahkan sepenuhnya. Anda akan mendapatkan penghasilan sebesar 95% dari jumlah harga yang dikutip yang akan ditransfer ke akun Anda. </li>
                    <li>Talenttra akan mentransfer penghasilan anda kepada anda jika order sudah mendapat status Selesai saja, anda bisa melihat istilah order Selesai dalam kategori order. </li>
                    <li>Pesanan tidak bisa dibatalkan apabila telah masuk revisi</li>
                    <li>Jika pesanan dibatalkan, jumlah total yang dibayarkan untuk order itu akan dikembalikan ke pemberi kerja 70%, dan dibayarkan ke creator 5% sesuai dengan kontrak Talenttra.</li>
                    <li>Penghasilan creator  akan ditransfer setelah status pekerjaan selesai.</li>
                    <li>Review yang diberikan akan dihitung dari skor review yang diberikan pemberi kerja kepada creator setelah creator  telah mengirimkan sebuah karya sesuai order. Review yang baik akan berdampak pada banyak manfaat masa depan bagi seorang creator.</li>

                </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Creator dapat mencantumkan karya mereka di Talenttra tanpa biaya apa pun.</li>
                    <li>Pekerjaan yang ditunjukkan kepada creator berkaitan dengan informasi yang disiapkan oleh pengguna itu sendiri.</li>
                    <li>Pekerjaan yang didaftar oleh creator dapat dihapus oleh Talenttra jika tidak mengikuti kontrak misalnya pekerjaan ilegal atau ada pelanggaran hak dan kekayaan intelektual atau layanan apa pun yang cenderung terkait dengan pornografi atau karya apa pun yang menurut Talenttra tidak sesuai. Layanan yang cenderung meniru layanan lainnya atau menjadi spam. Atau pekerjaan yang disadari Talenttra tidak sesuai atau mungkin menipu pemberi kerja atau melanggar kontrak pihak ketiga mana pun yang bukan pekerjaan mereka sendiri dan Talenttra mendapati ketidaksesuaian</li>
                    <li>Akun creator dapat ditangguhkan jika pekerjaan di mana freelancer terdaftar telah dihapus sesuai dengan alasan di atas.</li>
                    <li>Pekerjaan yang terhapus sesuai dengan alasan di atas tidak dapat diakses kembali untuk diedit lebih lanjut, atau digunakan pada sistem. </li>
                    <li>Setiap karya pasti memiliki gambar terkait pekerjaan dengan saluran untuk mengunggah 2 gambar oleh creator.</li>
                    <li>Setiap karya dapat memiliki video yang disetujui untuk dijadikan video terkait pekerjaan.</li>
                    <li>Seorang creator tidak boleh menambahkan informasi yang mengakibatkan perubahan dalam kontrak Talenttra. </li>

                </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penarikan pendapatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                   <li>Creator harus mengisi informasi rekening bank yang benar untuk dapat menarik dananya. </li>
                    <li>Pengguna dapat menarik maksimum sejumlah yang tersisa di akun pengguna saja. Sistem akan secara otomatis mentransfer sisa saldo total akun pengguna setiap hari Selasa minggu kedua, dan minggu keempat dalam sebulan tanpa biaya transfer.</li>
                    <li>Pengguna tidak dapat membatalkan penarikan dan tidak dapat menarik dana sebelum menetapkan jangka waktu penarikan.</li>
                    <li>Tidak ada biaya untuk penarikan dana </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemberi kerja </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                <li>Anda tidak dapat melakukan pembayaran ke freelancer melalui saluran lain selain saluran yang Talenttra yang telah siapkan di Talenttra.com </li>
                    <li>Apabila pembayaran dilakukan diluar situs maka apabila terjadi penipuan maka Talenttra tidak bertanggung jawab terhadap hal tersebut </li>
                    <li>Talenttra berhak menggunakan karya yang diberikan oleh pekerja lepas kepada pemberi kerja untuk keperluan iklan atau pemasaran Talenttra</li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembelian </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
               <li>Pemberi kerja harus melakukan pembayaran ke Talenttra untuk melakukan pemesanan dengan mengklik tombol Order pada halaman informasi pekerjaan yang diinginkan oleh pemberi kerja. </li>
                <li>Pemberi kerja dapat melakukan pembayaran dengan kartu kredit atau transfer uang . </li>
                <li>Biaya layanan dan biaya pengelolaan sistem untuk setiap pesanan dibebankan sebesar 10% dari besarnya honor pekerjaan . </li>
                <li>Informasikan kepada kami jika seorang freelancer meminta Anda untuk melakukan pembayaran dengan saluran lain</li>
                <li>Talenttra tidak menyimpan informasi kartu kredit dari pengguna mana pun untuk menghindari penipuan atau pencurian data, namun Talenttra memungkinkan perusahaan layanan pembayaran yang menyimpan informasi kartu kredit dengan tujuan melakukan pembayaran. Penggunaan informasi tersebut tunduk pada kontrak penggunaan dan kebijakan privasi perusahaan jasa pembayaran. </li>
            </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                <li>Setelah pembayaran ke sistem telah dikonfirmasi, sistem akan membuat pesanan untuk Anda dengan nomor pesanan. </li>
                <li>Creator harus mengirimkan pekerjaan atau layanan dengan mengklik tombol Serahkan karya akhir (di halaman kerja) untuk pemberi kerja yang telah melakukan pembayaran untuk pekerjaan sesuai dengan kontrak di halaman informasi pekerjaan. </li>   
                <li>Mengeklik Serahkan hasil kerja akhir yang tidak sesuai, misalnya mengirim pekerjaan yang belum selesai atau mengirim karya yang tidak mengikuti perjanjian/kontrak dapat mengakibatkan creator dituntut atau mendapatkan nilai review yang rendah atau ditangguhkan akunnya. </li>
                <li>Pesanan/order akan berstatus Selesai setelah status Menunggu persetujuan dan disetujui oleh pemberi kerja. Jika pemberi kerja tidak menanggapi atau mengevaluasi pekerjaan yang diajukan dalam 7 hari, status pesanan akan segera diubah menjadi Selesai. </li>
                <li>Talenttra  sangat menghargai jika seorang pemberi kerja dan seorang creator memecahkan masalah konflik di antara pemberi kerja dan creator di awal. Jika konflik tidak terselesaikan atau menyebabkan perselisihan, pengguna dapat menghubungi staf Talenttra. </li>
                <li>Order yang tidak aktif lebih dari 120 hari dianggap tidak valid. Talenttra berhak atas pemilikan total pembayaran ke dalam sistem tanpa pemberitahuan sebelumnya. </li>
            </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review dan nilai </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Jika pemberi kerja telah melakukan pembayaran untuk membuat pesanan, creator akan diberitahukan oleh sistem Talenttra via email, dan melalui layar situs Talenttra saat seorang creator mengakses website</li>
                    <li>Jika seorang creator tidak dapat menyerahkan pekerjaan pada tanggal jatuh tempo yang disepakati, creator dapat dituntut oleh pemberi kerja dan mungkin akan memengaruhi nilai review dan review yang diberikan kepada creator.</li>
                    <li>Seorang creator harus menyerahkan pekerjaan atau layanan yang telah selesai sesuai dengan yang creator sebutkan dalam deskripsi pekerjaan dengan mengklik Menyerahkan hasil kerja untuk mengubah status pesanan menjadi Diserahkan. </li>
                    <li>Pengguna bisa menghubungi staf Talenttra jika ada permintaan untuk mengubah status order menjadi status lain selain yang sistem sediakan. </li>  
              </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review dan nilai </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Review dan nilai yang diberikan oleh pemberi kerja mewakili kepuasan atas pekerjaan dan pelayanan yang diberikan oleh creator. </li>
                    <li>Review kerja dari seorang creator akan membuat creator lebih mudah memasuki top 100 creator. </li> 
                    <li>Memberikan review adalah hak pemberi kerja, review tidak akan dihapus dengan alasan apapun kecuali jika peninjauan tersebut melanggar kontrak penggunaan Talenttra. </li>
                    <li>Agar menghindari penggunaan sistem review dan penilaian dengan tujuan yang tidak diinginkan, pemberi kerja hanya dapat memberikan review dan skor hanya untuk pekerjaan yang telah dibayar dan dipesan oleh pemberi kerja melalui sistem Talenttra. </li>
                    <li>Review yang diberikan oleh pemberi kerja akan muncul di halaman informasi kerja. Pemberi kerja dapat memilih untuk tidak memberikan review.</li>    
                    <li>Creator tidak boleh menolak menyerahkan hasil kerja untuk memaksa mendapatkan review bagus atau nilai bagus dari pemberi kerja.</li> 
                    <li>Pemberi kerja dapat memberikan review terhadap creator kapan saja. </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permintaan pembatalan dan pembatalan pesanan/order </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                   <li>Talenttra menghargai jika pemberi kerja dan creator dapat memecahkan konflik antara pemberi kerja dan seorang creator di awal.  </li>
                   <li>Permintaan untuk menangguhkan pembayaran atau meminta pengembalian dana dari perusahaan jasa pembayaran atau bank atau orang lain selain Talenttra  dianggap melanggar kontrak penggunaan Talenttra. Tindakan tersebut akan menangguhkan sementara akun Anda dan Talenttra akan segera menyelidiki akun Anda.  </li>
                    <li>Pesanan yang dibatalkan akan mendapatkan pengembalian dana kepada pemberi kerja sebesar 70% saja, dan 5% kepada creator. </li>
                    <li>Staf Talenttra akan memeriksa kesesuaian pembatalan pesanan. Keputusan tersebut akan mencakup banyak faktor seperti pelanggaran kontrak, pelanggaran hak-hak lainnya, penggunaan yang tidak sesuai, atau menggunakan tombol Menyerahkan hasil kerja dengan tujuan yang tidak disengaja. </li>
                    <li>Pemesanan tidak dapat dibatalkan jika crator menyerahkan pekerjaan yang telah selesai yang telah sesuai dengan yang telah dijelaskan pada halaman informasi pekerjaan. Jika pemberi kerja tidak puas, pemberi kerja dapat memberikan review dan skor yang sesuai untuk pekerjaan creator. </li>
                    <li>Creator berhak membatalkan pesanan dan / atau sisa pembayaran pesanan jika kami menyadari adanya kecurangan dalam menggunakan sistem melalui pesanan tersebut. </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengembalian pembayaran </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                <li>Jumlah total yang terkait dengan pesanan yang dibatalkan akan dikembalikan ke rekening bank atau menjadi kredit pada akun Talenttra dari pemberi kerja. </li>    
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal13" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menginformasikan pelanggaran </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Jika sistem menemukan tindakan yang tidak sesuai atau mendapat informasi dari pengguna, FTalenttra  akan menginformasikan pengguna yang dilaporkan melalui email atau layar website kami saat pengguna masuk. </li>
                    <li>Memberikan informasi kepada akun yang dilaporkan tidak berpengaruh dalam pengguna sistem Talenttra, namun dapat menangguhkan akun pengguna di masa mendatang jika yang bersangkutan masih melakukan tindakan yang tidak sesuai pada sistem. </li>  
               </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal14" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penggunaan yang tidak semestinya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Talenttra tidak mengizinkan untuk membeli atau menjual karya atau layanan apa pun yang terkait dengan pornografi. </li>
                    <li>Pengguna harus saling menghormati satu sama lain. Untuk berkomunikasi via Talenttra harus menyajikan perilaku yang baik dan bersikap profesional. Talenttra mengambil tindakan tegas melawan pengguna yang cenderung menggertak atau menghina orang lain dengan kata-kata. –Talenttra mengutamakan keamanan pengguna terlebih dahulu. Pengguna tidak boleh bertindak dengan usaha untuk login dengan akun orang lain melalui Talenttra. Semua pengguna harus menghormati orang lain dengan tidak menghubungi orang lain untuk maksud komersial jika pengguna tidak menginginkannya. </li> 
                    <li>Pengguna tidak dapat mengungkapkan informasi pribadi pengguna lain. Untuk saling bertukar semua informasi pribadi yang dibutuhkan dalam bekerja melalui Talenttra hanya bisa terjadi melalui website. Dalam hal ini, pemberi kerja dan seorang creator mengkonfirmasi dan menerima untuk menggunakan informasi dari pihak lain hanya untuk kepentingan pekerjaan melalui  Talenttra semata. Pengguna yang mengikuti kontrak berkomunikasi akan dilindungi sesuai dengan kontrak penggunaan kami. </li>
                    <li>Pengguna tidak dapat menggunakan system Talenttra untuk tindakan yang ilegal. </li>
                    <li>Akun Talenttra tidak dapat ditransaksikan. </li>
                    <li>Talenttra  berhak menangguhkan akun sementara atau permanen jika Talenttra </li>
                    <li>Menemukan bahwa akun tersebut melanggar kontrak penggunaan atau melakukan tindakan yang tidak sesuai pada sistem. </li>
                    <li>Melanggar kontrak penggunaan Talenttra dapat menyebabkan akun Anda ditangguhkan. </li>
                    <li>Akun yang ditangguhkan tidak dapat melakukan transaksi apa pun pada sistem . </li>
                    <li>Pemilik akun yang ditangguhkan dapat menghubungi Talenttra untuk menanyakan informasi dan status akun apa pun.</li>
                    <li>Jika Talenttra menyelidiki kepemilikan akun pengguna. Pengguna harus menunjukkan kepemilikan akun dengan menyajikan referensi seperti KTP, buku bank, paspor, atau dokumen hukum yang dapat mengidentifikasi dirinya sendiri. </li> 
                    <li>Talenttra  berhak mengedit kontrak penggunaan yang sesuai. Jika ada perubahan, Talenttra akan menyajikan kontrak baru penggunaan di halaman ini dan pertimbangkan bahwa pengguna segera menerima kontrak baru ini. </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal15" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kepemilikan kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                <li>Kepemilikan dan pembatasan penggunaan hasil kerja yang diserahkan: jika creator tidak menyebutkan tentang pembatasan penggunaan karya atau layanan yang diajukan, dianggap bahwa pemberi kerja memegang kepemilikan penuh termasuk memiliki hak cipta dan hak atas kekayaan intelektual atas karya tersebut. </li>
                <li>Pemberi kerja dianggap sebagai pemilik pekerjaan jika dia telah melakukan pembayaran untuk pekerjaan tersebut.  </li>
                <li>Jika ada pembatalan pesanan sebelum diajukan, hak atas pekerjaan itu masih milik creator kecuali jika creator menyebutkan bahwa pemberi kerja dapat menggunakan konten tersebut meski pesanannya telah dibatalkan. </li>
                <li>Selain itu, semua komunikasi antara creator dan pemberi kerja dianggap sebagai konten pribadi yang tidak dapat diungkapkan oleh creator tanpa izin. </li>
                <li>Oleh karena itu, pengguna (pemberi kerja dan creator) menerima bahwa Talenttra berhak menggunakan konten yang diunggah pada Talenttra seperti pesan, foto, video, nama akun, atau data apa pun termasuk karya yang diajukan untuk iklan atau karya Talenttra lainnya. Tanpa perlu meminta izin dari pengguna. </li> 
    
            </ul>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal16" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Garansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                <li>Menggunakan situs Talenttra, data tentang situs Talenttra dan layanan apa pun atau produk apa pun yang Anda dapatkan dari website Talenttra adalah tanggung jawab Anda sendiri. tanpa jaminan apa pun diungkapkan atau tersirat. Talenttra atau orang yang terkait dengan Talenttra tidak bertanggung jawab atas kelengkapan, keamanan, keandalan, ketepatan, atau kesiapan website. </li>
                <li>Informasi di atas tidak berpengaruh untuk jaminan apa pun dan tidak dapat ditolak atau dibatasi sesuai undang-undang. </li>
            </ul>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal17" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status pesanan: freelancer mulai bekerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                <ul>
                    <li>Jika pemberi kerja telah melakukan pembayaran untuk membuat pesanan, creator akan diberitahukan oleh sistem Talenttra via email, dan melalui layar situs Talenttra saat seorang creator mengakses website</li>
                    <li>Jika seorang creator tidak dapat menyerahkan pekerjaan pada tanggal jatuh tempo yang disepakati, creator dapat dituntut oleh pemberi kerja dan mungkin akan memengaruhi nilai review dan review yang diberikan kepada creator. </li>
                    <li>Seorang creator harus menyerahkan pekerjaan atau layanan yang telah selesai sesuai dengan yang creator sebutkan dalam deskripsi pekerjaan dengan mengklik Menyerahkan hasil kerja untuk mengubah status pesanan menjadi Diserahkan. </li>
                    <li>Pengguna bisa menghubungi staf Talenttra jika ada permintaan untuk mengubah status order menjadi status lain selain yang sistem sediakan. </li>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    function searchKategori(data){
        console.log(data);
    }
</script>
@endsection