@extends('layouts.admin')

@section('content')
    @include('errors.check_error')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{ route('suppliers.view') }}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại nhà cung cấp</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Cập Nhật nhà cung cấp</li>
                            </ol>

                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin nhà cung cấp</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">

                                        <form action="" enctype="multipart/form-data" class="form-horizontal" role="form" >
                                            @csrf
                                            <div class="form-group row">
                                                <div class="form-group col-md-12">
                                                    <label for="InputName">Tên nhà cung cấp</label>
                                                    <input type="text" name="name" id="name"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           placeholder="Nhập tên" value="{{$supplier -> name}}">
                                                    <input type="hidden" name="id" id="id" class="form-control"
                                                           value="{{$supplier -> id}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="InputName">Email:</label>
                                                    <input type="text" name="email" id="email" class="form-control"
                                                           value="{{$supplier -> email}}">
                                                </div>
                                            </div>
                                            <hr>

                                            <hr>

                                            <div class="form-group row">
                                                <div class="form-group col-md-12">
                                                    <label for="InputName">Số Điện Thoại:</label>
                                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                                           value="{{$supplier -> phone_number}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="InputName">Địa Chỉ:</label>
                                                    <input type="text" name="address" id="address" class="form-control"
                                                           value="{{$supplier -> address}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Kích Hoạt</label>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" value="1" type="radio" id="active"
                                                               name="active" {{ $supplier->active == 1 ? 'checked' : '' }}>
                                                        <label for="active" class="custom-control-label">Có</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" value="0" type="radio" id="no_active"
                                                               name="active" {{ $supplier->active == 0 ? 'checked' : '' }}>
                                                        <label for="no_active" class="custom-control-label">Không</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-12 text-center">
                                                    <div class="text-lg-right mt-3 mt-lg-0">
                                                        <button data-href="{{route('suppliers.view')}}" data-url="{{ route('suppliers.update', ['id' => $supplier->id]) }}"  class="btn btn-success waves-effect waves-light mt-3 edit_supplier"><i class="mdi mdi-content-save mr-1"></i>Cập nhật</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card-box -->
                </div><!-- end row -->
            </div>
            <!-- end row -->
            <!-- end content -->
            <!-- end page title -->
        </div>
        <!-- container -->
    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{asset('admins/supplier/main.js')}}"></script>

    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
@endsection
