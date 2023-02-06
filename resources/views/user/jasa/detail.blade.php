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
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
                @if (count($carousel_images) > 0)
                <div class="row mb-3">
                    <div class="col-8">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($carousel_images); $i++)
                                <div class="carousel-item @if ($i == 0) active @endif">
                                    <img style="height:400px" class="d-block mx-auto img-fluid" src="{{asset('images/jasa_image/'.$carousel_images[$i]->url)}}" alt="{{$carousel_images[$i]->filename}}">
                                </div>
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            @for ($i = 0; $i < count($more_images); $i++)
                            <div class="col-6 mb-3">
                                <img class="rounded mr-2" onclick="showImage('{{asset('images/jasa_image/'.$more_images[$i]->url)}}')" alt="200x200" width="200" height="120px" src="{{asset('images/jasa_image/'.$more_images[$i]->url)}}" data-holder-rendered="true">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                @endif
                <div class="row mb-3 m-t-30">
                    <div class="col-md-8 pr-5">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="m-b-20 text-primary">{{$jasa->nama}}</h4>
                                <p>
                                    {!!$jasa->deskripsi!!}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-b-20 text-primary">Paket</h4>
                            </div>
                            @foreach ($paket as $data)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title font-20 mt-0">Paket : {{$data->nama}}</h4>
                                        <h5 class="card-subtitle text-secondary font-12 mb-3"><i class="fa fa-calendar"></i> Waktu pengerjaan {{$data->estimasi}} hari</h5>
                                        <p class="card-text">
                                            {{$data->deskripsi}}
                                        </p>
                                        <hr>
                                        <p class="card-text text-right">
                                            <button class="btn btn-primary px-4">Pilih Paket</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-pills nav-bg-custom nav-justified" role="tablist">
                                            @for ($i = 0; $i < count($paket); $i++)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if ($i == 0) active @endif" data-toggle="tab" href="#home-{{$i}}" role="tab">
                                                    <span class="d-none d-md-block">Rp. {{number_format($paket[$i]->harga)}}</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            @endfor
                                        </ul>
                                        <div class="tab-content">
                                            @for ($i = 0; $i < count($paket); $i++)
                                            <div class="tab-pane @if ($i == 0) active @endif p-3" id="home-{{$i}}" role="tabpanel">
                                                <h6 class="text-primary font-20 mt-0">Paket : {{$paket[$i]->nama}}</h6>
                                                <p class="font-14 mb-0">
                                                    {{$paket[$i]->deskripsi}}
                                                </p>
                                                <h6 class="text-secondary"><i class="fa fa-calendar"></i> Waktu pengerjaan {{$paket[$i]->estimasi}} hari</h6>
                                                <hr>
                                                <a href="{{url('jasa/invoice',$paket[$i]->id)}}" class="btn btn-primary btn-block">Pilih Paket</a>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mini-stats">
                                    <div class="p-3 mini-stats-content">
                                        <div class="media text-light">
                                            <i class="mx-3 my-auto thumb-md rounded-circle fa fa-shield fa-3x"></i>
                                            <div class="media-body my-2">
                                                <h4 class="mt-0">Keamanan</h4>
                                                <p class="text-white-70 mb-0">Mempekerjakan freelancer dengan aman melalui Talenttra. Tim support siap membantu untuk menindaklanjuti pekerjaan dan jaminan uang kembali.</p>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="show-image">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showImage(image_url){
        console.log(image_url)
        $('.show-image').html('<img src='+ image_url +' class="rounded" width="100%">')
        $('#imageModal').modal('show'); 
    }
</script>
@endsection