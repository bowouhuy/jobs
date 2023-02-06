@extends('admin.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><h4 class="mt-0 header-title my-auto">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right"><a href="{{url('admin/kategori')}}" class="btn btn-secondary text-right px-5"><i class="fa fa-angle-left"></i> Kembali </a></div>
                </div>
                <hr>
              <form action="{{url('admin/kategori/update',$kategori->id)}}" method="post">
                @csrf
                <div class="progress m-b-30">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
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
                <input type="hidden" name="id" value="{{$kategori->id ?? ''}}">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nama" value="{{$kategori->nama ?? ''}}" placeholder="Nama Kategori">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" name="icon" value="{{$kategori->icon ?? ''}}" placeholder="Icon Kategori">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary px-3"> Simpan <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            height: 300,  
            minHeight: 300,   
            maxHeight: null,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
@endsection