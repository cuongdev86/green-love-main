@extends('layouts.admin')
@section('title')
| Cập nhật bài viết
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
                    <h1 class="m-0">Cập nhật bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Cập nhật bài viết</li>
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
                            <form action="{{route('posts.update',['id' => $post->id] )}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Chọn chủ đề <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                <!-- <option value="">--- Chưa có chủ đề ---</option> -->
                                                @foreach($categories as $cate)
                                                <option {{$post->category_id == $cate->id ? 'selected' : ''}} value="{{$cate->id}}">{{$cate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tiêu đề <span class="text-danger">*</span></label>
                                            <input name="name" value="{{$post->name}}" type="text" class="form-control" required placeholder="Nhập tiêu đề">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <input name="describe" value="{{$post->describe}}" type="text" class="form-control" placeholder="Nhập tiêu đề">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <input name="image" type="file" accept="image/*" class="form-control-file" onchange="previewImage(event)"> <br>
                                            <img id="preview" src="{{$post->image}}" alt="Ảnh xem trước" style="max-width: 300px; max-height: 300px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nội dung</label>
                                            <textarea id="summernote" name="content">
                                            {{$post->content}}
                                            </textarea>
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


    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            preview.style.display = 'block'; // Hiển thị thẻ img khi có ảnh được chọn
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none'; // Ẩn thẻ img khi không có ảnh được chọn
            preview.src = "";
        }
    }
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