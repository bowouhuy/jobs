@extends('mitra.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><h4 class="mt-0 header-title">List {{ $title }}</h4></div>
                    <div class="col-md-6 text-right"><a href="{{url('mitra/jasa/form_jasa')}}" class="btn btn-primary text-right px-5"><i class="fa fa-plus mr-1"></i> Tambah Data </a></div>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <!-- <th>Image</th> -->
                            <th class="text-center">Nama Jasa</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Mitra</th>
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
            ajax: "{{ url('mitra/jasa/list') }}",
            "order": [[ 0, "desc" ]],
            columns: [
                {data: 'id', name: 'id'},
                // {data: 'jasa_image', name: 'jasa_image'},
                {data: 'nama', name: 'nama'},
                {data: 'rating', name: 'rating'},
                {data: 'nama_mitra', name: 'nama_mitra'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

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