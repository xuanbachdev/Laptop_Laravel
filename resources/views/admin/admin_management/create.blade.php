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
                                <div class="content-header">
                                    <div class="content">
                                        <div class="container-fluid">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{route('staffs.store')}}" class="form" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">Họ tên</label>
                                                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                                            @error('name')
                                                            <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                                                            @error('username')
                                                            <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Password</label>
                                                            <input type="password" onkeypress="return event.charCode != 32" name="password" id="password" class="form-control" value="{{old('password')}}">
                                                            @error('password')
                                                            <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="mail" name="email" id="email" class="form-control" value="{{old('email')}}">
                                                            @error('email')
                                                            <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                                                            @enderror
                                                        </div>
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="">Ảnh đại diện</label>--}}
{{--                                                            <input type="file" name="avatar_path" id="avatar_path" class="form-control">--}}
{{--                                                            @error('avatar_path')--}}
{{--                                                            <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
                                                        <div class="form-group">
                                                            <label for="">Quyền</label>
                                                            <select name="role_id" id="role" class="form-control">
                                                                @foreach($admins  as $key => $admin_role)
                                                                    <option value="{{ $key }}" @if(request()->query('role_id')===$key) selected @endif>{{ $admin_role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row justify-content-md-center">
                                                                <button type="submit" class="btn btn-primary mr-sm-4">Lưu</button>
                                                                <button type="reset" class="btn btn-default mr-sm-4" style="margin-left: 20px">Nhập lại</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
