@extends('layouts.admin')
@section('title')
| Cập nhật âm thanh
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('admins/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('admins/plugins/summernote/summernote-bs4.min.css')}}">
<!-- CodeMirror -->
<link rel="stylesheet" href="{{asset('admins/plugins/codemirror/codemirror.css')}}">
<link rel="stylesheet" href="{{asset('admins/plugins/codemirror/theme/monokai.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    {{-- content header  --}}
    <div class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cập nhật âm thanh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Cập nhật âm thanh</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end content header --}}
    {{-- main content  --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('audios.update', ['id'=>$audio->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Chọn chủ đề <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                @foreach($categories as $cate)
                                                <option value="{{$cate->id}}" {{$audio->category_id == $cate->id ? 'selected' : ''}}>{{$cate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tên <span class="text-danger">*</span></label>
                                            <input name="name" value="{{$audio->name ? $audio->name : ''}}" type="text" class="form-control" required placeholder="Nhập tiêu đề">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <input name="description" value="{{$audio->description ? $audio->description : ''}}" type="text" class="form-control" placeholder="Nhập tiêu đề">
                                        </div>
                                        <div class="form-group">
                                            <label for="">File âm thanh</label>
                                            <input name="file" type="file" class="form-control-file"> <br>
                                            <audio controls>
                                                <source src="{{$audio->file_path}}" type="audio/ogg">
                                            </audio>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-submit btn-primary float-right">Lưu lại</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
    {{-- end main content --}}
</div>
@endsection
@section('js')
<script src="{{asset('admins/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('#category_id').select2();
    });
</script>
<!-- Summernote -->
<script src="{{asset('admins/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- CodeMirror -->
<script src="{{asset('admins/plugins/codemirror/codemirror.js')}}"></script>
<script src="{{asset('admins/plugins/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('admins/plugins/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('admins/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
@endsection