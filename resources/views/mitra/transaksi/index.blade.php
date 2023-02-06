@extends('mitra.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><h4 class="mt-0 header-title">List {{ $title }}</h4></div>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th>Kode Invoice</th>
                            <th class="text-center">Nama Jasa</th>
                            <th>Image</th>
                            <th>Deskripsi Pekerjaan</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Mitra</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Datatable -->
                    </tbody>
                </table>
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
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('admin_template/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_template/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
<script>
    $(document).ready(function() {
        var dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('mitra/transaksi/list') }}",
            "order": [[ 0, "desc" ]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'kode_invoice', name: 'kode_invoice'},
                {data: 'jasa.nama', name: 'jasa.nama'},
                {data: 'jasa_image', name: 'jasa_image'},
                {data: 'deskripsi', name:'deskripsi'},
                {data: 'tanggal_transaksi', name: 'tanggal_transaksi'},
                {data: 'nama_mitra', name: 'nama_mitra'},
                {data: 'status_transaksi', name: 'status_transaksi'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
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