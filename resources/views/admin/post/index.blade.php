@extends('layouts.admin')
@section('title')
| Bài viết
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('admins/plugins/daterangepicker/daterangepicker.css')}}">    
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('admins/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admins/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admins/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('admins/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('admins/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('admins/plugins/dropzone/min/dropzone.min.css')}}">
<style>
    .icon-delete {
        color: red;
    }

    .icon-delete:hover {
        color: #d50909;
    }
    .status-active{
        background-color: #5aa15a; padding: 0.5rem; color: #fff; border-radius: 4px;
    }
    .status-pedding{
        background-color: #7676e1; padding: 0.5rem; color: #fff; border-radius: 4px;
    }
    .status-cancel{
        background-color: #ed5d5d; padding: 0.5rem; color: #fff; border-radius: 4px;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    {{-- content header  --}}
    <div class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bài viết</li>
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
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">Danh sách</h3>
                                <a class="btn btn-primary float-right" href="{{route('posts.create')}}"><i class="fas fa-plus-circle"></i> Thêm</a>
                        </div>
                        <div class="card-body">
                            <label for="">Tìm kiếm</label>
                            <div class="filter">
                                <form action="{{route('posts.index')}}" method="get">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" name="name" class="form-control" placeholder="Tìm kiếm tiêu đề...">
                                        </div>
                                        <div class="col-4">
                                            <select name="category_id" id="category_id" class="form-control" id="">
                                                <option value="">Chủ đề</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select name="status" id="status" class="form-control" id="">
                                                <option value="">Trạng thái</option>
                                                <option value="{{\App\Enums\PostEnum::PenddingTemp}}">Đang xử lý</option>
                                                <option value="{{\App\Enums\PostEnum::Approved}}">Đang hoạt động</option>
                                                <option value="{{\App\Enums\PostEnum::Cancel}}">Bị hủy</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br style="margin: 0.1em 0;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                  <div class="input-group date" id="reservationdatefrom" data-target-input="nearest">
                                                      <input type="text" name="from_date" placeholder="Từ ngày..." class="form-control datetimepicker-input" data-target="#reservationdatefrom"/>
                                                      <div class="input-group-append" data-target="#reservationdatefrom" data-toggle="datetimepicker">
                                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                      </div>
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="col-4">
                                            {{-- <div class="form-group">
                                                <div class="input-group date" id="reservationdateto" data-target-input="nearest">
                                                    <input type="text" name="to_date" placeholder="Đến ngày..." class="form-control datetimepicker-input" data-target="#reservationdateto"/>
                                                    <div class="input-group-append" data-target="#reservationdateto" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-submit btn-light" style="background-color: aliceblue"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Chủ đề</th>
                                        <th>Trạng thái</th>
                                        {{-- <th>Người đăng</th> nếu là admin thì hiển thị dòng này  --}}
                                        <th>Cập nhật cuối</th>
                                        <th><i class="fas fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td><img src="{{$post->image}}" alt="Image"></td>
                                        <td>{{$post->name}}</td>
                                        <td>{{optional($post->category)->name}}</td>
                                        <td>
                                            @if($post->status == \App\Enums\PostEnum::Approved)
                                                <span class="status-active">Đang hoạt động</span>
                                            @elseif($post->status == \App\Enums\PostEnum::Cancel)
                                                <span>Bị Hủy</span>
                                            @else 
                                                <span class="status-pedding">Đang xử lý</span>
                                            @endif
                                        </td>
                                        <td>{{$post->updated_at->format('d/m/Y H:i:s')}}</td>
                                        <td>
                                            <a href=""><i class="fas fa-edit"></i></a> &nbsp; &nbsp;
                                            <a onclick=""><i class="fas fa-trash-alt icon-delete"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
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
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('admins/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('admins/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admins/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('admins/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('admins/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admins/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('admins/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('admins/plugins/dropzone/min/dropzone.min.js')}}"></script>
<script>
    $(function () {

        // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    
    //Money Euro
    $('[data-mask]').inputmask()


            $('#reservationdatefrom').datetimepicker({
                format: 'L'
            });
            
            $('#reservationdateto').datetimepicker({
                format: 'L'
            });
            $('#status').select2();
            $('#category_id').select2();
    });
    
</script>
@endsection