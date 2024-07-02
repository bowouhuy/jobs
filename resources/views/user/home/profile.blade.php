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
            <div class="col-xl-3 col-md-6">
                <div class="card product-sales">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4"><i class="ion-monitor h4 mr-2 text-primary"></i> Profile</h5>
                        <div class="row align-items-center mb-4">
                            <div class="col-12">
                                <img src="{{asset('images/user_image/sample.png')}}" class="rounded-circle mx-auto d-block" alt="...">
                                <h4 class="text-center">{{Auth::user()->username}}</h4>
                                <div class="text-muted text-center">{{Auth::user()->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-3 header-title">Order</h4>
                        <div class="table-responsive mt-4">
                            <table id="datatable2" class="table dt-responsive nowrap" style=" border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">Nama Jasa</th>
                                    <th class="text-center">Nama Mitra</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Status Transaksi</th>
                                    <th class="text-center">Status Order</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center">{{$order->id}}</td>
                                        <td class="text-center">{{$order->jasa->nama}}</td>
                                        <td class="text-center">{{$order->mitra->first_name}} {{$order->mitra->last_name}}</td>
                                        <td class="text-center">{{$order->created_at}}</td>
                                        <td class="text-center">{{($order->transaksi->status == 'waiting') ? "Menunggu Pembayaran" : ''}}</td>
                                        <td class="text-center">{{$order->status}}</td>
                                        <td class="text-center">
                                            <a href="{{ url('order/detail', $order->id) }}" class="btn btn-primary">Detail</a>
                                            @if($order->transaksi->status == 'waiting')
                                                <a href="{{ url('transaksi/payment') . '?order_id=' . $order->id }}" class="btn btn-primary">Bayar</a>
                                            @else
                                            <button class="btn btn-primary" onclick="confirm_transaksi('{{$order->image_url}}', {{$order->id}})">Confirm</button>
                                            @endif
                                        </td>
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

<!-- MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
            <div class="modal-footer">
                <form action="{{url('admin/transaksi/store')}}" method="post">
                @csrf
                    <input type="hidden" name="confirm_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Confirm</button> -->
                </form>
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
<script>
    $(document).ready(function() {
    });

    function confirm_transaksi(image_url, id_transaksi){
        console.log(image_url)
        console.log(id_transaksi)
        $('.show-image').html('<img src='+ image_url +' class="rounded" width="100%">')
        $('[name="confirm_id"]').val(id_transaksi); 
        $('#imageModal').modal('show'); 
    }
    function delete_jasa(jasa_id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url("mitra/jasa/delete_jasa")}}' + '/' + jasa_id,
                    success: function (data){
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(()=> {
                            window.location.replace("{{ url('mitra/jasa')}}")
                        })
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        })
    };
</script>

@endsection