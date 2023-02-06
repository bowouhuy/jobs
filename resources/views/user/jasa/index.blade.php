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
                <div class="row mb-3">
                    <div class="col-md-7">
                        <h5 class="m-t-30 m-b-20">Pekerjaan yang ditemukan {{count($jasa)}} Item</h5>
                    </div>
                    <div class="col-md-5 text-right m-t-30 m-b-20">
                        <form action="{{url('jasa')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-8">
                                    <input type="text" name="search" value="{{request('search')}}"class="form-control" placeholder="Pencarian Jasa">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-search"></i></button>
                                    <a href="{{url('jasa/'.$subkategori_id)}}" class="btn btn-secondary px-3 ml-1"><i class="fa fa-refresh"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @foreach ($jasa as $data)
                    <div class="col-md-3">
                        <div class="card">
                            <a href="{{url('jasa/detail', $data->id)}}">
                                @if ($data->image)
                                <img class="card-img-top img-fluid" style="height: 200px;" src="{{asset('images/jasa_image/'.$data->image)}}" alt="{{$data->image}}">
                                @else
                                <img class="card-img-top img-fluid" src="user_template/assets/images/small/img-4.jpg" alt="No Image">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title font-10 mt-0">{{$data->nama}}</h6>
                                    <!-- <p class="card-text">{{Str::limit($data->deskripsi), 50, $end='...'}}</p> -->
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
    </div>
</div>
@endsection