@extends('user.layouts.main')

@section('custom-script')
<script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
@endsection

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
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="invoice-title">
                                                    <h4 class="pull-right font-16 mr-2"><strong>{{$order->transaksi->kode_invoice}}</strong></h4>
                                                    <h4 class="mt-0 ml-2">
                                                        <img src="{{asset('icon/logo.png')}}" alt="logo" height="30"/>
                                                        <span class="text-warning h5 font-weight-bold ml-2">Talenttra</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <address class="ml-2">
                                                        <strong>Customer Detail</strong><br>
                                                        {{$customer->first_name}} {{$customer->last_name}}<br>
                                                        {{$customer->email}}<br>
                                                        {{$customer->no_hp}}<br>
                                                        <strong>Notes :</strong><br>
                                                        {{$order['description']}}<br><br>
                                                </address>
                                            </div>
                                            <div class="col-6 text-right">
                                                <address class="mr-2">
                                                    <strong>Penyedia Jasa</strong><br>
                                                    {{$mitra->first_name}} {{$mitra->last_name}} <br>
                                                    {{$mitra->email}} <br>
                                                    <a href="http://api.whatsapp.com/send?phone={{$mitra->no_hp}}">Kirim pesan untuk mengirimkan detail lebih lanjut </a><br>
                                                    <strong>Order Date:</strong><br>
                                                    {{date('d-m-Y')}}<br><br>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="panel panel-default">
                                            <div class="p-2">
                                                <h3 class="panel-title font-16"><strong>Order summary</strong></h3>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="snap-container" style="width:100%"></div>
                            </div>
                        </div> 
                    </div>
                </div>
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
    snapToken = '{{$order['transaksi']['snap_code']}}';
console.log(snapToken);
    window.snap.embed(snapToken, {
        embedId: 'snap-container'
    });
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

    var payButton = document.getElementById('pay-button');
    var snapToken = '';
    {{--payButton.addEventListener('click', function () {--}}
    {{--    $.ajax({--}}
    {{--            type: 'POST',--}}
    {{--            url: '{{ url("invoice/store")}}',--}}
    {{--            data: {--}}
    {{--                _token: '{{ csrf_token() }}',--}}
    {{--                paket_id: '{{$paket->id}}',--}}
    {{--            },--}}
    {{--            success: function (data){--}}
    {{--                // console.log(data.snap);--}}
    {{--                snapToken = data.snap;--}}
    {{--                console.log(snapToken);--}}
    {{--                window.snap.embed(snapToken, {--}}
    {{--                    embedId: 'snap-container'--}}
    {{--                });--}}
    {{--            },--}}
    {{--            error: function(e) {--}}
    {{--                console.log(e);--}}
    {{--            }--}}
    {{--    });--}}
    {{--    // disable pay button--}}
    {{--    payButton.disabled = true;--}}
    {{--});--}}
        
</script>
@endsection