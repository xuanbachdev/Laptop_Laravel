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
                                <li class="breadcrumb-item active">Danh mục sản phẩm</li>
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
                                    <th >ID</th>
                                    <th >Tên nhà cung cấp</th>
                                    <th >Email</th>
                                    <th >Số điện thoại</th>
                                    <th >Địa chỉ</th>
                                    <th >Chức năng</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i=1 ?>
                                @foreach($listSupplier as $listSuppliers)
                                    <tr>
                                        <td>{{$listSuppliers->id}}</td>
                                        <td>{{$listSuppliers->name}}</td>
                                        <td>{{$listSuppliers->email}}</td>
                                        <td>{{$listSuppliers->phone_number}}</td>
                                        <td>{{$listSuppliers->address}}</td>
                                        <td width="25%">
                                            <a  href="{{route('suppliers.edit', ['id'=>$listSuppliers->id])}}"  class="btn btn-success btn-primary"  role="button">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="#" data-url="{{route('suppliers.delete', ['id'=>$listSuppliers->id])}}" class="btn btn-danger pull-right action_delete" role="button">
                                                <i class="fa fa-trash"></i> Xoá
                                            </a>
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
    @include('admin.suppliers.add')
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{asset('admins/supplier/main.js')}}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
