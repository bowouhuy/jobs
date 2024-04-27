@extends('user.layouts.main')

@section('body')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$jasa->jasa->nama}}</h4>
                            <h5 class="card-title">{{$jasa->nama}}</h5>
                            <p class="card-text">{{$jasa->deskripsi}}</p>
                            <p class="card-text">Rp. {{number_format($jasa->harga)}}</p>
                            <img style="height:400px" class="d-block mx-auto img-fluid" src="{{asset('images/jasa_image/'.$jasa->jasa->jasaimages[0]->url)}}" alt="{{$jasa->jasa->jasaimages[0]->filename}}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title
                            ">Detail Pesanan</h4>
                            <form action="{{url('transaksi/form_order/confirm')}}" method="post">
                                @csrf
                                <input type="hidden" name="jasa_id" value="{{$jasa->jasa_id}}">
                                <input type="hidden" name="paket_id" value="{{$jasa->id}}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Pesan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pesan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="attaachment">Attachment <span class="text text-danger">* Optional</span></label>
                                    <input type="file" class="form-control" name="attaachment" id="attaachment">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection