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
                                <a href="{{route('products.add')}}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i>Thêm Mới</a>
                            </div>
                        </div>
                        <ol class="breadcrumb page-title">
                            <li class="breadcrumb-item"><a href="index.php">LAPTOP</a></li>
                            <li class="breadcrumb-item active">Sản Phẩm</li>
                        </ol>
                    </div>

                </div>
            </div>
            <!-- content -->
            <div class="row">
                    <div class="col-12">
{{--                        <div class="card-box">--}}
                            <div class="row">

                                </div>
                               <!-- end col-->
{{--                            </div> <!-- end row -->--}}
                        </div> <!-- end card-box -->
                    </div><!-- end col-->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <table id="example" class="table table-success table-bordered" style="width:100%">
                                <thead>
                                <tr class="info">
                                    <th class="text-center" >STT</th>
                                    <th class="text-center" >ID</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Ảnh sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center" >Chức năng</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i = 1?>
                                @foreach($listProduct as $products)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$products->id}}</td>
                                        <td>{{$products->name}}</td>
                                        <td><img width="50px" height="50px" src="{{$products->feature_image_path}}" alt=""></td>
                                        <td>{{ $products->quantity }} <span class="btn text-muted" data-toggle="modal" data-target="#modal-add-{{ $products->id }}"><i class="fa fa-plus"></i></span></td>
                                        <div class="modal fade" id="modal-add-{{ $products->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Thêm số lượng sản phẩm</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('products.updateQuantity',$products->id)}}" method="post">
                                                            <p>{{ $products->name }}&hellip;</p>
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Số lượng: </label>
                                                                <input type="number" name="quantity" class="form-control" id="" min="0" step="1">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left"
                                                                data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @php
                                            $statusArray = ['Hết hàng','Sắp về hàng','Đang kinh doanh','Không kinh doanh'];
                                            $colors = ['red','orange','green','gray']
                                        @endphp
                                        <td>
                                            <i class="label bg-{{$colors[$products->product_status]}}">{{$statusArray[$products->product_status]}}</i>
                                        </td>
                                        </td>
                                        <td width="25%">
                                            <a  href="{{route('products.edit', $products->id)}}"  class="btn btn-success btn-primary"  role="button">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="#" data-url="{{route('products.delete', $products->id)}}" class="btn btn-danger pull-right action_delete" role="button">
                                                <i class="fa fa-trash"></i> Xoá
                                            </a>
                                        </td>
                                        </td>
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
@stop

@section('js')
    <script src="{{asset('admins/js/style.js')}}"></script>
    <script src="{{asset('admins/sweetalert2/sweetalert2@11.js')}}"></script>
@endsection
