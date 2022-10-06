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
                                    <a href="{{route('sliders.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Thêm slider</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông Tin bài viết</h4>
                            <hr>
                            <form action="{{route('sliders.store')}}" enctype="multipart/form-data" method="post">
                                @csrf

                                <div class="content-header">
                                    <div class="content">
                                        <div class="container-fluid">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col form-group col-md-6">
                                                            <label for="InputName">Tên slider:</label>
                                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên slider" value="{{old('name')}}">
                                                            @error('name')
                                                            <div class="alert alert-danger">{{ $message }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col form-group col-md-6">
                                                            <label for="InputName">URL slider:</label>
                                                            <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="Nhập đường link slider" value="{{old('url')}}">
                                                            @error('url')
                                                            <div class="alert alert-danger">{{ $message }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col form-group col-md-6">
                                                            <div class="custom-file">
                                                                <label>Ảnh slider:</label>
                                                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path" id="image_path">
                                                                @error('image_path')
                                                                <div class="alert alert-danger">{{ $message }}
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <span>Xem trước: </span>
                                                            <img  style="margin-top: 10px;" id="image_upload" width="150px" height="150px">
                                                        </div>
                                                        <div class="col form-group col-md-6">
                                                            <label>Trạng Thái (Hiện/Ẩn):</label>
                                                            <div class="checkbox">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" value="1" type="radio" id="active" name="status" checked="">
                                                                    <label for="active" class="custom-control-label">Hiển thị</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="status">
                                                                    <label for="no_active" class="custom-control-label">Ẩn</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phân loại:</label>
                                                                <div>
                                                                    <div class="radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="type" id="" value="1" checked>
                                                                            Slider
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="type" id="" value="2" {{ old('type')==2?'checked':'' }}>
                                                                            Banner
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-md-center">
                                                        <button type="submit" class="btn btn-primary mr-sm-4">Thêm</button>
                                                        <button type="reset" class="btn btn-warning mr-sm-4" style="margin-left: 20px">Nhập lại</button>
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

                reader.onload = function(e) {
                    $('#image_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_path").change(function() {
            readURL(this);
        });

    </script>
@endsection
