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
                        @include('errors.check_error')
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{route('coupons.add')}}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i>Thêm Mới</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">LAPTOP</a></li>
                                <li class="breadcrumb-item active">Mã khuyến mại</li>
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
                                <th >ID</th>
                                <th>Tên chương trình khuyến mãi</th>
                                <th >Mã khuyến mại</th>
                                <th >Chức năng</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i=1 ?>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td width="25%">
                                        <a  href="{{route('coupons.edit', $coupon->id)}}"  class="btn btn-success btn-primary"  role="button">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                        <a href="#" data-url="{{route('coupons.delete', $coupon->id)}}" class="btn btn-danger pull-right action_delete" role="button">
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
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
