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
                                <a href="{{ route('categories.view') }}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại danh mục Sản Phẩm</a>
                            </div>
                        </div>
                        <ol class="breadcrumb page-title">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                            <li class="breadcrumb-item active">Cập Nhật danh mục Sản Phẩm</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- content -->
             <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        @include('errors.check_error')
                        <h4 class="header-title">Thông tin danh mục Sản Phẩm</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="p-2">

                                    <form action="" enctype="multipart/form-data" class="form-horizontal" role="form" >
                                       @csrf
                                        <div class="form-group row">
                                            <div class="form-group col-md-10">
                                                <label for="InputName">Tên danh mục:</label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" value="{{$category -> name}}">
                                                <input type="hidden" name="id" id="id" class="form-control" value="{{$category -> id}}">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label for="InputName">Chọn danh mục cha:</label>
                                                <select class="form-control" name="parent_id" id="parent_id">
                                                    <option value="0">---Danh mục cha---</option>
                                                    {!! $htmlOption !!}
                                                </select>
                                            </div>
                                        </div>
                                        <hr>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label class="col-form-label">Trạng thái</label>
                                                <select name="status" class="form-control" id="active">
                                                    @if( $category->status ==1)
                                                        <option selected value="1">Hiển Thị</option>
                                                        <option value="0">Ẩn</option>
                                                    @else
                                                        <option value="1">Hiển Thị</option>
                                                        <option selected value="0">Ẩn</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="text-lg-right mt-3 mt-lg-0">
                                                    <button type="submit" data-url="{{ route('categories.update', $category->id) }}" class="btn btn-success waves-effect waves-light mt-3 btn_category"><i class="mdi mdi-content-save mr-1"></i>Cập nhật</button>
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
    <!-- content -->
</div>
@endsection
@section('js')
    <script>
        $('.btn_category').on('click', function(event) {
            $('.sub_error').hide();
            event.preventDefault();
            var _token = $("input[name='_token']").val();
            var name = $('#name').val();
            var parent_id = $('#parent_id').val();
            var status = $('#active').val();
            var id = $('#id').val();
            let urlRequest = $(this).data('url');
            $.ajax({
                url: urlRequest,
                type: 'POST',
                data: { _token: _token, id: id, name: name, parent_id: parent_id, status:status },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Sửa danh mục thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.setTimeout(function(){
                            location.href = "{{route('categories.view')}}";
                        } ,500);
                    }
                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // $('#success_message').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class= "sub_error" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }
            });

        });
    </script>
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
@endsection
