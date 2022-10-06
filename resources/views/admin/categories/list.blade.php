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
                                    <th class="text-center" >STT</th>
                                    <th class="text-center" >ID</th>
                                    <th class="text-center">Tên danh mục</th>
{{--                                    <th class="text-center">Ngày tạo</th>--}}
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center" >Chức năng</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i=1 ?>
                                    @foreach($categories as $cate)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$cate->id}}</td>
                                            <td>{{$cate->name}}</td>
{{--                                            <td>{{date('d-m-Y', strtotime($cate->created_at))}}</td>--}}
                                            <td>
                                                @if($cate->status == 1)
                                                    Hiển thị
                                                @else
                                                    Ẩn
                                                @endif
                                            </td>
                                            <td >
                                                <a  href="{{route('categories.edit', ['id' => $cate->id])}}"  class="btn btn-success btn-primary"  role="button">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>
                                                <a href="#" data-url="{{route('categories.delete', ['id' => $cate->id])}}" class="btn btn-danger pull-right action_delete" role="button">
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
    @include('admin.categories.add')
@endsection

@section('js')
    <script src="{{asset('admins/category/main.js')}}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
