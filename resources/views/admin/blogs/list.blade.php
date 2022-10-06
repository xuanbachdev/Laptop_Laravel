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

                                    <a class="btn btn-primary" href="{{route('blogs.add')}}" ><i class="fa fa-plus"></i>
                                        Thêm bài viết</a>

                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">Laptop</a></li>
                                <li class="breadcrumb-item active">Bài viết</li>
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
                                    <th >Tên bài viết</th>
                                    <th >Trạng thái</th>
                                    <th >Chức năng</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php $i=1 ?>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$blog->id}}</td>
                                        <td>{{$blog->title}}</td>
                                        <td>
                                            @if ($blog->status==1)
                                                <span class="label bg-green">Hiển thị</span>
                                            @else
                                                <span class="label bg-gray">Ẩn</span>
                                            @endif
                                        </td>
                                        <td width="25%">
                                            <a  href="{{route('blogs.edit', $blog->id)}}"  class="btn btn-success btn-primary"  role="button">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="#" data-url="{{route('blogs.delete', $blog->id)}}" class="btn btn-danger pull-right action_delete" role="button">
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
