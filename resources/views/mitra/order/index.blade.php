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
                            <th class="text-center">Nama Jasa</th>
                            <th class="text-center">Nama Customer</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Status Transaksi</th>
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
<!-- <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{url('mitra/jasa/form_images_store')}}" class="dropzone" id="dropzone" method="post">
                        @csrf
                        <input type="hidden" name="jasa_id" value="">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                        </form> 
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
</div> -->

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
                                <form action="/mitra/order/form_order_store" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="transaksi_id" id="transaksi_id" type="hidden" value="">
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

<script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/plugins/dropzone/dist/dropzone.js')}} "></script>
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
            ajax: "{{ url('mitra/order/list') }}",
            "order": [[ 0, "desc" ]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'jasa.nama', name: 'jasa.nama'},
                {data: 'nama_customer', name: 'nama_customer'},
                {data: 'tanggal_transaksi', name: 'tanggal_transaksi'},
                {data: 'status_transaksi', name: 'status_transaksi'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone(".dropzone", { 
        maxFilesize: 12,
        uploadMultiple: false, 
        maxFiles: 1,
        // renameFile: function(file) {
        //     var dt = new Date();
        //     var time = dt.getTime();
        //     return time+file.name;
        // },
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
                url: '{{ url("mitra/order/delete_files")}}' + '/' + name,
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
                    window.location.replace("{{ url('/mitra/order/')}}")
                }, 2000)
            )
        },
        error: function(file, response)
        {
            return false;
        }
    });

    $('#btn-submit').on('click',function(){
        var id = document.getElementById('row_id').value;
        document.getElementById("transaksi_id").setAttribute('value',id);
        myDropzone.processQueue();
    });
</script>

@endsection