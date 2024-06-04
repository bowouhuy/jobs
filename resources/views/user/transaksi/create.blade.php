@extends('user.layouts.main')

@section('body')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$paket->jasa->nama}}</h4>
                            <h5 class="card-title">{{$paket->nama}}</h5>
                            <p class="card-text">{{$paket->deskripsi}}</p>
                            <p class="card-text">Rp. {{number_format($paket->harga)}}</p>
                            <img style="height:400px" class="d-block mx-auto img-fluid" src="{{asset('images/jasa_image/'.$paket->jasa->jasaimages[0]->url)}}" alt="{{$paket->jasa->jasaimages[0]->filename}}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detail Pesanan</h4>
                            <form action="{{url('order/store')}}" method="post" type="multipart/form-data">
                                @csrf
                                <input type="hidden" name="jasa_id" value="{{$paket->jasa_id}}">
                                <input type="hidden" name="paket_id" value="{{$paket->id}}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Pesan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="attaachment">Attachment <span class="text text-danger">* Optional</span></label>
                                    <input type="file" class="form-control" name="attachment" id="attachment">
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td width="30%"><strong>Jasa</strong></td>
                                            <td width="30%" class="text-center"><strong>Paket</strong></td>
                                            <td class="text-center"><strong>Estimasi</strong>
                                            </td>
                                            <td class="text-right"><strong>Harga</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$paket->jasa->nama}}</td>
                                            <td class="text-center">{{$paket->nama}}</td>
                                            <td class="text-center">{{$paket->estimasi}} Hari</td>
                                            <td class="text-right">Rp. {{number_format($paket->harga)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center">
                                                <strong>Subtotal</strong></td>
                                            <td class="thick-line text-right">Rp. {{number_format($paket->harga)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Tax</strong></td>
                                            <td class="no-line text-right">Rp. {{number_format($paket->harga*0.10)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Total</strong></td>
                                            <td class="no-line text-right"><h4 class="m-0">Rp. {{number_format($paket->harga+($paket->harga*0.10))}}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
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