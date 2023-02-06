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
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Username</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Tanggal Register</th>
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
                <form action="{{url('admin/mitra/store')}}" method="post">
                @csrf
                    <input type="hidden" name="user_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Verifikasi</button>
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
            ajax: "{{ url('admin/mitra/list') }}",
            "order": [[ 0, "desc" ]],
            columns: [
                {data: 'username', name: 'username'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'register_tanggal', name: 'register_tanggal'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ],
            "columnDefs": [
            {
                "targets": [4,5,6],
                "className": "text-center",
            }
        ],
        });
    });

    function verifikasi_user(image_url, id){
        $('.show-image').html('<img src='+ image_url +' class="rounded" width="100%">')
        $('[name="user_id"]').val(id); 
    }

</script>
@endsection