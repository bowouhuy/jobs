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
                                <li class="breadcrumb-item"><a href="{{url('jasa/detail', $jasa->id)}}">Detail</a></li>
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
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="pull-right font-16"><strong>Order # {{date('YmdHis')}}</strong></h4>
                                    <h3 class="mt-0">
                                        <img src="{{asset('icon/logo.png')}}" alt="logo" height="20"/>
                                <span class="text-warning h5 font-weight-bold ml-2">Talenttra</span>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            {{$customer->first_name}} {{$customer->last_name}}<br>
                                            {{$customer->email}}<br>
                                        </address>
                                    </div>
                                    <div class="col-6 text-right">
                                        <address>
                                            <strong>Shipped To:</strong><br>
                                            admin@talenttra.id<br>
                                            1234 Main<br>
                                            Apt. 4B<br>
                                            Springfield, ST 54321
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 m-t-30">
                                        <address>
                                            <strong>Payment Method:</strong>
                                            <h6>Bank Utama:</h6>
                                            BRI 7000-01-017411-53-0<br>
                                            (Khaulah Aqilah Sanaba)<br>
                                            <h6>Bank Lainnya:</h6>
                                            Mandiri Syariah / BSI 7131183326<br>
                                            (Khaulah Aqilah Sanaba)<br>
                                            <br>Mandiri 1100011247928<br>
                                            (Lara Arilisa Kinanti)<br>
                                            <br>BNI 0803055094<br>
                                            (Suci Fazriyah Nurrahmi)<br>
                                        </address>
                                    </div>
                                    <div class="col-6 m-t-30 text-right">
                                        <address>
                                            <strong>Penyedia Jasa:</strong><br>
                                            {{$mitra->email}} <br>
                                            {{$mitra->first_name}} {{$mitra->last_name}} <br>
                                            <a href="http://api.whatsapp.com/send?phone={{$mitra->no_hp}}">Kirim pesan untuk mengirimkan detail lebih lanjut </a><br>
                                            <strong>Order Date:</strong><br>
                                            {{date('d-m-Y')}}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="">
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
                                                    <td>{{$jasa->nama}}</td>
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

                                        <div class="d-print-none">
                                            <div class="pull-right">
                                                <!-- <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a> -->
                                                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#uploadModal">Konfirmasi Pembayaran</button>
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
<!-- MODAL KONFIRMASI PEMBAYARAN -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran <small class="text-warning">( *Only 1 file to upload)</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <label for="file">Deskripsi Pekerjaan</label>
                    <input class="form-control" type="text" id="deskripsi" placeholder="Jelaskan deksripsi pekerjaan">
            </div>
                <form action="{{url('invoice/store')}}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                @csrf
                <input name="paket_id" type="hidden" value="{{$paket->id}}">
                <input type="hidden" name="deskripsi">

                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-submit" class="btn btn-primary">Send Files</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('user_template/assets/js/jquery.min.js')}} "></script>
<script src="{{ asset('user_template/assets/plugins/dropzone/dist/dropzone.js')}} "></script>
<script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
<script>
$(document).ready(function() {
    $('#deskripsi').change(function (){
        $('[name="deskripsi"]').val($(this).val())
    })
})
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone(".dropzone", { 
        maxFilesize: 12,
        uploadMultiple: false, 
        maxFiles: 1,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        },
        parallelUploads: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        autoProcessQueue: false,
        timeout: 50000,
        removedfile: function(file) 
        {
            var name = file.name;
            $.ajax({
                type: 'GET',
                url: '{{ url("invoice/delete_files")}}' + '/' + name,
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) 
        {
            swal({
                title: 'Success!',
                text: 'Konfirmasi Pembayaran Berhasil!',
                type: 'success',
                showConfirmButton: false
            }).then(
                setTimeout(function () {
                    window.location.replace("{{ url('/')}}")
                }, 2000)
            )
        },
        error: function(file, response)
        {
            return false;
        }
    });

    $('#btn-submit').on('click',function(){
        myDropzone.processQueue();
    });
        
</script>
@endsection