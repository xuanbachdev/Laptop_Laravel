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

                                    <a class="btn btn-primary" href="{{route('cpus.add')}}" ><i class="fa fa-plus"></i>
                                        Thêm thông tin CPU</a>

                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">Laptop</a></li>
                                <li class="breadcrumb-item active">CPU</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Hãng</th>
                                    <th>Series</th>
                                    <th>Thế hệ</th>
                                    <th>GPU tích hợp</th>
                                    <th>Số nhân - Số luồng</th>
                                    <th>Xung nhịp</th>
                                    <th>Cache</th>
                                    <th>Thời gian sửa</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                @foreach($cpuList as $cpu)
                                    <tr>
                                        <td>{{$cpu->id}}</td>
                                        <td>{{$cpu->name}}</td>
                                        <td>{{$cpu->brand}}</td>
                                        <td>{{$cpu->series}}</td>
                                        <td>{{$cpu->gen}}</td>
                                        <td>{{$cpu->integrated_gpu}}</td>
                                        <td>{{$cpu->cores}}C-{{$cpu->threads}}T</td>
                                        <td>{{$cpu->base_clock}}-{{$cpu->turbo_clock}}</td>
                                        <td>{{$cpu->cache}}</td>
                                        <td>{{$cpu->updated_at}}</td>
                                        <td >
                                            <a  href="{{route('cpus.edit', ['id' => $cpu->id])}}"  class="btn btn-success btn-primary"  role="button">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="#" data-url="{{route('cpus.delete', ['id'=> $cpu->id])}}" class="btn btn-danger pull-right action_delete" role="button">
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
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
