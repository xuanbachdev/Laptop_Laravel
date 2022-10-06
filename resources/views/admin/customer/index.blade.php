@extends('layouts.admin')

@section('css')

@endsection

@section('content')
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
                                    <a href="#" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal-add"><i class="mdi mdi-plus-circle mr-1"></i>Thêm Mới</a>

                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">Laptop</a></li>
                                <li class="breadcrumb-item active">Quản lý khách hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <table id="example" class="table table-success table-bordered" style="width:100%">
                                <thead>
                                <tr class="info">
                                    <th>Họ tên</th>
                                    <th>SDT</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
{{--                                    <th>Tùy chọn</th>--}}
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i=1 ?>
                                @foreach ($customerList as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
{{--                                        <td>--}}
{{--                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
{{--                                                <i class="fa fa-pencil-square-o"></i>--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
                                    </tr>
                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Sửa thông tin khách hàng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('customers.update',$customer->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Họ tên: </label>
                                                                    <input type="text" name="name" id="" class="form-control" placeholder="Nhập họ tên..."
                                                                           value="{{ $customer->name }}">
                                                                    @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Địa chỉ: </label>
                                                                    <input type="text" name="address" id="" class="form-control" placeholder="Nhập địa chỉ..."
                                                                           value="{{ $customer->address }}">
                                                                    @error('address')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">SDT: </label>
                                                                    <input type="text" name="phone_number" id="" class="form-control" placeholder="Nhập số điện thoại..."
                                                                           value="{{ $customer->phone_number }}">
                                                                    @error('phone_number')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Email: </label>
                                                                    <input type="mail" name="email" id="" class="form-control" placeholder="Nhập địa chỉ email..."
                                                                           value="{{ $customer->email }}">
                                                                    @error('email')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                <nav>
                    <ul class="pagination pagination-rounded mb-3">
                    </ul>
                </nav>
                <!-- end content -->
                <!-- end page title -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
    </div>
@endsection

@section('js')
    <script src="{{asset('admins/category/main.js')}}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
