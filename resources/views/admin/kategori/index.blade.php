@extends('admin.layouts.main')

@section('body')
<div class="row">
@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
          <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><h4 class="mt-0 header-title">List {{ $title }}</h4></div>
                    <div class="col-md-6 text-right"><a href="{{url('admin/kategori/create')}}" class="btn btn-primary text-right px-5"><i class="fa fa-plus mr-1"></i> Tambah Data </a></div>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <!-- <th>Image</th> -->
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Icon</th>
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
            ajax: "{{ url('admin/kategori/list') }}",
            "order": [[ 0, "desc" ]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'icon', name: 'icon'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function delete_kategori(kategori_id){
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
                    url: '{{ url("admin/kategori/delete_kategori")}}' + '/' + kategori_id,
                    success: function (data){
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(()=> {
                            window.location.replace("{{ url('admin/kategori')}}")
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