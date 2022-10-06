@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        @include('errors.check_error')
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{route('staffs.index')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Thêm nhân viên</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin nhân viên</h4>
                            <hr>
                            <div style="display:block;margin: 0 auto;width:250px;height:250px">
                                <img class="mx-auto" style="display:block; width:100%; height:100%" src="{{asset($admin->avatar_path)}}" alt="">
                            </div>
                            <form action="{{route('staffs.update',$admin->id)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="content-header">
                                    <div class="content">
                                        <div class="container-fluid">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label for="">Thay đổi họ tên:</label>
                                                            <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                                                            @error('name')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="">Thay đổi username:</label>
                                                            <input type="text" name="username" class="form-control" value="{{$admin->username}}">
                                                            @error('username')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label for="">Thay đổi email:</label>
                                                            <input type="mail" name="email" class="form-control" value="{{$admin->email}}">
                                                            @error('email')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
{{--                                                        <div class="col form-group col-md-6">--}}
{{--                                                            <div class="custom-file">--}}
{{--                                                                <label>Ảnh:</label>--}}
{{--                                                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path" id="image_path">--}}
{{--                                                                @error('image_path')--}}
{{--                                                                <div class="alert alert-danger">{{ $message }}--}}
{{--                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                                                                </div>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                            <span>Xem trước: </span>--}}
{{--                                                            <img  style="margin-top: 10px;" id="image_upload" width="150px" height="150px" src="{{asset( $admin->avatar_path) }}">--}}
{{--                                                        </div>--}}
                                                        <div class="col-md-6 form-group">
                                                            <label for="">Thay đổi Quyền:</label>
                                                            <select class="form-control" @if($admin->id == Auth::guard('admin')->user()->id) disabled @endif name="role_id" id="">
                                                                @foreach($role as $admin_role)
                                                                    <option value="{{ $admin_role->id }}" @if($admin->role_id===$admin_role->id) selected @endif>{{ $admin_role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('avatar')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-md-center">
                                                        <button type="submit" class="btn btn-primary mr-sm-4">Lưu</button>
                                                        <button type="reset" class="btn btn-default mr-sm-4" style="margin-left: 20px">Nhập lại</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-box -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <!-- end content -->
            <!-- end page title -->
        </div>
        <!-- container -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_path").change(function () {
            readURL(this);
        });

    </script>
@endsection
