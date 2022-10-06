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

                                    <a class="btn btn-primary" href="{{route('gpus.add')}}" ><i class="fa fa-plus"></i>
                                        Thêm thông tin GPU</a>

                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">Laptop</a></li>
                                <li class="breadcrumb-item active">GPU</li>
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
                                    <th>Hãng</th>
                                    <th>Series</th>
                                    <th>Tên mẫu</th>
                                    <th>Dung lượng V-ram</th>
                                    <th>Xung nhịp</th>
                                    <th>Ngày ra mắt</th>
                                    <th>Thông tin thêm</th>
                                    <th>Thời gian sửa</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($gpuList as $gpu)
                                    <tr>
                                        <td>{{$gpu->id}}</td>
                                        <td>{{$gpu->brand}}</td>
                                        <td>{{$gpu->series}}</td>
                                        <td>{{$gpu->name}}</td>

                                        <td>{{$gpu->graph_memory_cap}}</td>
                                        <td>{{$gpu->clock}}</td>
                                        <td>{{date('d-m-Y', strtotime($gpu->release_date))}}</td>
                                        <td>{{$gpu->addition}}</td>
                                        <td>{{date('d-m-Y', strtotime($gpu->updated_at))}}</td>
                                        <td >
                                            <a  href="{{route('gpus.edit', ['id' => $gpu->id])}}"  class="btn btn-success btn-primary"  role="button">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="#" data-url="{{route('gpus.delete', ['id' => $gpu->id])}}" class="btn btn-danger pull-right action_delete" role="button">
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
    <script src="{{asset('vendors/admin/gpu/main.js')}}"></script>
@endsection
