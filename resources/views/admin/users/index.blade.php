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
                                <li class="breadcrumb-item active">Quản lý người dùng</li>
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
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>SDT</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i=1 ?>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>

                                            <span class="btn text-success" data-toggle="modal" data-target="#modal"> <i class="fa fa-eye"></i></span>

                                            <div class="modal fade" id="modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Thông tin User</h4>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Họ và tên: <strong>{{$user->name}}</strong></p>
                                                            <p>Email: <strong><a href="mailto:{{$user->email}}">{{$user->email}}</a></strong></p>
                                                            <p>Số điện thoại:<strong><a href="tel:{{$user->phone_number}}">{{$user->phone_number}} </a></strong></p>
                                                            <p>Địa chỉ: <strong>{{$user->address}}</strong></p>
                                                            <p>Giới tính: <strong>{{$user->gender==1?'Nam':'Nữ'}}</strong></p>
                                                            <p>Ngày sinh: <strong>{{$user->birthday}}</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-right"
                                                                    data-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
