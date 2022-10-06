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
                                    <a href="{{route('staffs.create')}}"><button class="btn bg-purple"><i class="fa fa-plus"></i> Thêm mới</button></a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">LAPTOP</a></li>
                                <li class="breadcrumb-item active">Nhân viên</li>
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
                                <th>ID</th>
{{--                                <th>Avatar</th>--}}
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Ngày Thêm</th>
{{--                                <th>Ngày Sửa</th>--}}
                                <th>Tùy Chọn</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i=1 ?>
                            @foreach($adminsList as $admin)
                                <tr>
                                    <td>
                                        {{$admin->id}}
                                    </td>
{{--                                    <td>--}}
{{--                                        <img style="width:75px;height:75px" src="{{asset($admin->avatar_path)}}" alt="{{$admin->name}}">--}}
{{--                                    </td>--}}
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->username}}</td>
                                    <td>{{date('d-m-Y', strtotime($admin->created_at))}}</td>
{{--                                    <td>{{$admin->updated_at}}</td>--}}
                                    <td><a href="{{route('staffs.edit',$admin->id)}}"><button title="Sửa thông tin" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                                        @if($admin->id!=Auth::guard('admin')->user()->id)
{{--                                            <form style="display:inline" action="{{route('staffs.destroy',$admin->id)}}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('delete')--}}
                                                <button title="Xóa" type="button" data-url="{{route('staffs.destroy',$admin->id)}}" class="btn btn-danger action_delete"><i class="fa fa-trash-o"></i></button>
{{--                                            </form>--}}
                                        @endif
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
