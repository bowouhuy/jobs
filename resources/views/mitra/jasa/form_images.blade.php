@extends('mitra.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">{{ $title }}</h4>
                <hr>
                <div class="progress m-b-30">
                    <div class="progress-bar" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <form action="{{url('mitra/jasa/form_images_store')}}" class="dropzone" id="dropzone" method="post">
                        @csrf
                        <input type="hidden" name="jasa_id" value="{{$jasa_id}}">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{url('mitra/jasa/form_jasa',$jasa_id)}}" class="btn btn-secondary px-3"><i class="fa fa-angle-left"></i> Sebelumnya</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{url('mitra/jasa/form_paket',$jasa_id)}}" class="btn btn-primary px-3">Selanjutnya <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/plugins/dropzone/dist/dropzone.js')}} "></script>
<script>
    var myDropzone = new Dropzone(".dropzone", { 
        maxFilesize: 12,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file) 
        {
            var name = file.name;
            $.ajax({
                type: 'GET',
                url: '{{ url("admin/jasa/delete_files")}}' + '/' + name,
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ? 
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) 
        {
            console.log(response)
        },
        error: function(file, response)
        {
            return false;
        },
        init: function() {
            var base_url = '{{url('/')}}';
            $.ajax({
                type: 'GET',
                url: '{{ url("helper/get_jasa_images")}}' + '/' + '{{$jasa_id}}',
                success: function (data){
                    $.each(data, function(key, value){
                        console.log(value.name)
                        var mockFile = {name: value.name, size: value.size};
                        // var myDropzone = new Dropzone("#dropzone");
                        // Dropzone.displayExistingFile(mockFile, base_url + '/images/jasa_image/');
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
						myDropzone.options.thumbnail.call(myDropzone, mockFile, base_url + '/images/jasa_image/' + value.name);
						myDropzone.emit("complete", mockFile);
                    })
                },
                error: function(e) {
                    console.log(e);
                }
            });
            

        }
    });

</script>
@endsection