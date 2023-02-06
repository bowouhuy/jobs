@extends('mitra.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">{{ $title }}</h4>
                <hr>
                <div class="progress m-b-30">
                    <div class="progress-bar" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                        @if (count($paket) < 2)
                        <button class="btn btn-primary" onclick="add_paket()"><i class="fa fa-plus mr-1"></i>Tambah Paket</button>
                        @endif
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Paket</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Estimasi</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $n = 1
                                @endphp
                                    @foreach($paket as $data)
                                    <tr>
                                        <td class="text-center">{{$n++}}</td>
                                        <td>{{$data->nama}}</td>
                                        <td>{{$data->deskripsi}}</td>
                                        <td>{{$data->estimasi}} Hari</td>
                                        <td>{{number_format($data->harga)}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning" onclick="edit_paket('{{$data->id}}')" id="btn-edit"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger" onclick="delete_paket('{{$data->id}}', '{{$jasa_id}}')"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span class="text-warning">*NB : Maksimal Mengisi 2 Paket</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{url('mitra/jasa/form_images',$jasa_id)}}" class="btn btn-secondary px-3"><i class="fa fa-angle-left"></i> Sebelumnya</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{url('mitra/jasa')}}" class="btn btn-primary">Selesai <i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="paketModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{url('mitra/jasa/form_paket_store')}}" method="post">
            @csrf
            <input type="hidden" name="jasa_id" value="{{$jasa_id}}">
            <input type="hidden" name="paket_id">
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Paket</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="nama" type="text" placeholder="Nama Paket">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Estimasi</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="estimasi" type="number" placeholder="Estimasi">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Harga</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="harga" type="number" placeholder="Harga">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('user_template/assets/js/jquery.min.js')}} "></script>
<script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
<script>
    function add_paket(){
        $('[name="paket_id"]').val('')
        $('[name="nama"]').val('')
        $('[name="deskripsi"]').val('')
        $('[name="estimasi"]').val('')
        $('[name="harga"]').val('')
        $('#paketModal').modal('show');
    }

    function edit_paket(paket_id){
        $.ajax({
            type: 'GET',
            url: '{{ url("helper/get_paket")}}' + '/' + paket_id,
            success: function (data){
                $('[name="paket_id"]').val(data.id)
                $('[name="nama"]').val(data.nama)
                $('[name="deskripsi"]').val(data.deskripsi)
                $('[name="estimasi"]').val(data.estimasi)
                $('[name="harga"]').val(data.harga)
                $('#paketModal').modal('show');
            },
            error: function(e) {
                console.log(e);
            }
        });
        
    }

    function delete_paket(paket_id, jasa_id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result)
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url("mitra/jasa/delete_paket")}}' + '/' + paket_id,
                    success: function (data){
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(()=> {
                            window.location.replace("{{ url('mitra/jasa/form_paket')}}" + "/" + jasa_id)
                        })
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        })
    }
</script>
@endsection