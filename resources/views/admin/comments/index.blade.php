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
                                    <a href="{{route('sliders.add')}}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i>Thêm Mới</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">LAPTOP</a></li>
                                <li class="breadcrumb-item active">Slider</li>
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
                                <th class="font-weight-medium">Duyệt</th>
                                <th class="font-weight-medium">Tên</th>
                                <th class="font-weight-medium">Bình Luận</th>
                                <th class="font-weight-medium">Điểm</th>
                                <th class="font-weight-medium">Ngày</th>
                                <th class="font-weight-medium">Sản Phẩm</th>
                                <th class="font-weight-medium">Thao Tác</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i=1 ?>
                            @foreach ($comment_customer as $key=>$comment)
                                <tr>
                                    <td>
                                        @csrf
                                        @if($comment->status==1)
                                            <input type="button" data-comment_status="0" data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}" class="btn btn-primary btn-xs comment_approval" value="Đã duyệt" >
                                        @else
                                            <input type="button" data-comment_status="1" data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}" class="btn btn-danger btn-xs comment_approval" value="Chưa duyệt" >
                                        @endif
                                    </td>
                                    <td>
                                        {{ $comment->name }}
                                    </td>
                                    <td>
                                        {{ $comment->content }}
                                        {{--  <style type="text/css">
                                            ul.list_rep li {
                                              list-style-type: decimal;
                                              color: blue;
                                              margin: 5px 40px;
                                          }
                                          </style>
                                          <ul class="list_rep">
                                            Trả lời :
                                            @foreach($comment_admin as $key => $ad_comment)
                                              @if($ad_comment->binhluan_id_phan_hoi==$comment->id)
                                                <li> {{$ad_comment->binhluan_noi_dung}}</li>
                                              @endif
                                            @endforeach
                                          </ul>
                                          @if($comment->binhluan_trang_thai==0)
                                          <br/><textarea class="form-control reply_comment_{{$comment->id}}" rows="5"></textarea>
                                          <br/><button class="btn btn-success btn-xs btn-reply-comment" data-product_id="{{$comment->sanpham_id}}"  data-comment_id="{{$comment->id}}">Reply To Comment</button>
                                          @endif  --}}
                                    </td>
                                    <td>
                                        @for($count = 1; $count <=5; $count++)
                                            @if($count <= $comment->points)
                                                <i class="fa fa-star ratting_review"></i>
                                            @else
                                                <i class="fa fa-star ratting_no_review"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime( $comment->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $comment->Product->name }}
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href=""><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Chi Tiết</a>
{{--                                                <a class="dropdown-item" href="" onclick="return confirm('Xóa bình luận?')"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Xóa</a>--}}
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
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
    <script type="text/javascript">
        $('.comment_approval').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            if(comment_status==0){
                var alert = 'UnApproval Success';
            }else{
                var alert = 'Approval Success';
            }
            $.ajax({
                url:"{{url('admin/comments/approval-comment')}}",
                method:"POST",
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id,_token:_token},
                success:function(data){
                    location.reload();
                    $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');
                }
            });
        });
    </script>
@endsection
