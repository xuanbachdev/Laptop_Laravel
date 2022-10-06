@extends('layouts.master')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <style>
        #example_paginate{
            margin-right: 20px;
        }
        .page-item.disabled .page-link{
            width: 70px;
        }
        .page-item:first-child .page-link {
            width: 70px;
        }
        .page-item:last-child .page-link{
            width: 70px;
        }

    </style>
@endsection

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Trang Chủ</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Tài Khoản</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--breadcrumbs area end-->
    <!-- Start Maincontent  -->
    @include('errors.check_error')
    <section class="main_content_area">
        <div class="account_dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#account-details" data-toggle="tab" class="nav-link active">Chi tiết tài
                                    khoản</a></li>
                            <li><a href="#orders" data-toggle="tab" class="nav-link">Lịch sử đơn Hàng</a></li>
                            {{--                            <li> <a href="#coupon-code" data-toggle="tab" class="nav-link">Nhận Mã Giảm Giá</a></li>--}}
                            <li><a href="#change-password" data-toggle="tab" class="nav-link">Đổi Mật Khẩu</a></li>
                            {{--                            <li><a href="{{URL::to('/logout-customer')}}" onclick="return confirm('Đăng Xuất?')" class="nav-link">Đăng Xuất</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active" id="account-details">
                            <h3>Chi Tiết Tài Khoản </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form action="{{route('customer.updateInfo')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-radio">
                                                <span class="custom-radio"><input type="radio" value="1"
                                                                                  {{ Auth::user()->gender == 1 ? 'checked' : '' }} name="customer_gender"> Nam</span>
                                                <span class="custom-radio"><input type="radio" value="0"
                                                                                  {{ Auth::user()->gender == 0 ? 'checked' : ''}} name="customer_gender"> Nữ</span>
                                            </div>
                                            <br>
                                            <label>Họ tên</label>
                                            <input type="text" value="{{ Auth::user()->name }}" name="customer_name">
                                            <label>Email</label>
                                            <input type="text" value="{{ Auth::user()->email }}" name="customer_email"
                                                   readonly class="ant-input ant-input-disabled">
                                            <label>Số điện thoại</label>
                                            <input type="text" value="{{ Auth::user()->phone_number }}"
                                                   name="customer_phone_number">
                                            <label>Địa chỉ</label>
                                            <input type="text" value="{{ Auth::user()->address }}"
                                                   name="customer_address">
                                            <label>Ngày sinh</label>
                                            <input type="date" value="{{ Auth::user()->birthday }}" name="birthday">
                                            <label>Ảnh</label>
                                            <input type="file"
                                                   class="form-control-file @error('image_path') is-invalid @enderror"
                                                   name="avatar_path" id="image_path">
                                            @error('image_path')
                                            <div class="alert alert-danger">{{ $message }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            @enderror
                                            <span>Xem trước: </span>
                                            <img style="margin-top: 10px;" id="image_upload" width="150px"
                                                 height="150px" src="{{ Auth::user()->avatar_path }}">
                                            <br>
                                            <span class="custom_checkbox">
                                                <label><br><em> </em></label>
                                            </span>
                                            <div class="save_button primary_btn default_button">
                                                <button class="btn btn-success">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="orders">
                            <h3>Chi tiết đơn đặt hàng</h3>
                            <div class="coron_table">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Thông tin giao hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                        $i = 1;
                                    @endphp
                                    @foreach (Auth::user()->customer()->with('order')->get() as $customer)
                                        @foreach ($customer->order()->with('detail')->orderBy('created_at', 'desc')->get()  as $key => $order)

                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $order->order_code }}</td>

                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    {{ "$customer->name, $customer->phone, $customer->address" }}
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($order->detail()->with('product')->get()
                    as $detail)
                                                            <li>
                                                                @php
                                                                    $product = $detail->product()->first();
                                                                    $total += $detail->final_price;
                                                                @endphp
                                                                <a href="{{ route('products.show', $product->slug) }}"><span
                                                                        style="word-break: break-all">{{ $product->name }}</span>
                                                                    <span
                                                                        style="margin-left: auto; background-color: red; color: white; padding: 2px 3px; border-radius: 3px;">{{ number_format($detail->final_price) }}đ</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{ number_format($total) }} đ
                                                </td>
                                                <td>
                                                    {{ $statusArray[$order->status] }}
                                                </td>
                                                <td>
                                                    @if ($order->status < 2)
                                                        <a href="{{route('order.history.cancel',$order->order_code)}}"
                                                           class="btn btn-link"
                                                           onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?')"
                                                           title="Hủy đơn hàng"><i class="fa fa-times text-danger"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--                        <div class="tab-pane fade" id="coupon-code">--}}
                        {{--                            <h3>Mã Giảm Giá</h3>--}}
                        {{--                            <div class="coron_table table-responsive">--}}
                        {{--                                <table class="table">--}}
                        {{--                                    <thead>--}}
                        {{--                                        <tr>--}}
                        {{--                                            <th>Nội Dung</th>--}}
                        {{--                                            <th>Mã Giảm Giá</th>--}}
                        {{--                                            <th>Giá Trị</th>--}}
                        {{--                                        </tr>--}}
                        {{--                                    </thead>--}}
                        {{--                                    <tbody>--}}
                        {{--                                    @if($all_coupon_code!=null)--}}
                        {{--                                        @foreach ($all_coupon_code as $key=>$coupon)--}}
                        {{--                                            <tr>--}}
                        {{--                                                <td>{{ $coupon->name }}</td>--}}
                        {{--                                                <td>{{ $coupon->code }}</td>--}}
                        {{--                                                <td>--}}
                        {{--                                                    @if($coupon->type==1)--}}
                        {{--                                                        {{number_format($coupon->discount_amount,0,',','.' )." VND" }}--}}
                        {{--                                                    @else--}}
                        {{--                                                        {{number_format($coupon->discount_percent,0,',','' )." %" }}--}}
                        {{--                                                    @endif--}}
                        {{--                                                </td>--}}
                        {{--                                            </tr>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    @else--}}
                        {{--                                        <tr>--}}
                        {{--                                            <td colspan="6" >--}}
                        {{--                                                <h4 style="text-align: center" class="alert alert-danger">Không Có Mã Giảm Giá!</h4>--}}
                        {{--                                            </td>--}}
                        {{--                                        </tr>--}}
                        {{--                                         @endif--}}
                        {{--                                    </tbody>--}}
                        {{--                                </table>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="tab-pane" id="change-password">
                            <h3>Đổi Mật Khẩu</h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form action="{{route('customer.changPassword')}}" method="POST">
                                            @csrf
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" name="old_password">
                                            @error('old_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <label>Mật khẩu mới</label>
                                            <input type="password" name="new_password">
                                            @error('new_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <label>Xác nhận mật khẩu mới</label>
                                            <input type="password" name="confirm_new_password">
                                            @error('confirm_new_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <br>
                                            <span class="custom_checkbox">
                                                <label><br><em> </em></label>
                                            </span>
                                            <div class="primary_btn text-center">
                                                <button type="submit" class="btn btn-success">Cập nhập</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Maincontent  -->
@endsection

@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_path").change(function () {
            readURL(this);
        });

    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('admins/js/style.js')}}"></script>
@endsection
