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
                                    <a href="{{route('blogs.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại bài viết</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Thêm bài viết</li>
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
                            <form action="{{route('blogs.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="content-header">
                                    <div class="content">
                                        <div class="container-fluid">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col form-group col-md-8 @error('title') has-error @enderror">
                                                            <label for="InputName">Tên bài viết:</label>
                                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Nhập tên bài viết" value="{{old('title')}}">
                                                            @error('title')
                                                            <div class="alert alert-danger">{{ $message }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col form-group col-md-6">
                                                            <div class="custom-file">
                                                                <label>Ảnh blog:</label>
                                                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_blog" id="image_blog">
                                                                @error('image_blog')
                                                                <div class="alert alert-danger">{{ $message }}
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <span>Xem trước: </span>
                                                            <img  style="margin-top: 10px;" id="image_upload" width="150px" height="150px">
                                                        </div>
                                                        <div class="col form-group col-md-8">
                                                            <div class="form-group @error('meta_keyword') has-error @enderror">
                                                                <label for="">Từ khóa seo: </label>
                                                                <input type="text" name="meta_keyword" id="" placeholder="Danh sách từ khóa" class="form-control select1_init" value="{{old('meta_keyword')}}">
                                                                @error('meta_keyword')
                                                                <div class="alert alert-danger">{{ $message }}
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col form-group col-md-8">
                                                            <div class="form-group @error('meta_description') has-error @enderror">
                                                                <label for="">Mô tả ngắn bài viết: </label>
                                                                <input type="text" name="meta_description" id="" placeholder="Mô tả ngắn bài viết" class="form-control" value="{{old('meta_description')}}">
                                                                @error('meta_description')
                                                                <div class="alert alert-danger">{{ $message }}
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col form-group col-md-8">
                                                            <div class="form-group @error('contents') has-error @enderror">
                                                                <label for="">Nội dung bài viết: </label>
                                                                <textarea  rows="10" class="form-control tinymce_editor_init  @error('contents') is-invalid @enderror error-messages" rows="10" name="contents" id="editor_init" placeholder="Mô tả sản phẩm..." value="">{{old('contents')}}</textarea>
                                                                @error('contents')
                                                                <div class="alert alert-danger">{{ $message }}
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                </div>
                                                                @enderror
                                                            </div>
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

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-md-center">
                                                        <button type="submit" class="btn btn-primary mr-sm-4">Thêm</button>
                                                        <button type="reset" class="btn btn-warning mr-sm-4">Nhập lại</button>
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

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="https://cdn.tiny.cloud/1/y1miufxpg75c7j08s6ns0f0cv0dfe1go8v9993r994g3fhwa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        $(function() {
            $(".tag_select_choose").select2({
                tags: true,
                tokenSeparators: [',', ''],
            })

            $(".select2_init").select2({
                placeholder: "-----",
                allowClear: true
            })


            let options = {
                filebrowserImageBrowseUrl: '/filemanager?type=Images',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('editor_init', options);
        });

    </script>
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

        $("#image_blog").change(function() {
            readURL(this);
        });

    </script>
@endsection

