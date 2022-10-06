@extends('layouts.admin')

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
                                    <a href="{{route('orders.index')}}"
                                       class="btn btn-success waves-effect waves-light"><i
                                            class="ti-arrow-left mr-1"></i>Quay Lại Đơn Hàng</a>
                                    <a href="#" class="btn btn-success waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle mr-1"></i>Thêm Mới</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="index.php">LAPTOP VIP</a></li>
                                <li class="breadcrumb-item active">Chi Tiết Đơn Hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                @include('errors.check_error')

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông Tin Đơn Hàng</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="col-form-label"><h4>Thông Tin Khách Hàng</h4></label>
                                                    <div class="table-responsive" id="ajax-queue">
                                                        <table class="table table-hover  mb-0 table-bordered">
                                                            @php
                                                                $customer = $order->customer()->first();
                                                            @endphp
                                                            <thead>
                                                            <tr>
                                                                <td>Họ tên</td>
                                                                <td>Số Điện Thoại</td>
                                                                <td>Email</td>
                                                                <td>Địa Chỉ</td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(isset($customer))
                                                                <tr>
                                                                    <td>{{ $customer->name}} </td>
                                                                    <td>{{$customer->phone_number }}</td>
                                                                    <td>{{ $customer->email}}</td>
                                                                    <td>{{$customer->address }}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><h4>Không Có Thông Tin</h4></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="col-form-label"><h4>Thông Tin Đơn Hàng</h4></label>
                                                    <div class="table-responsive" id="ajax-queue">
                                                        <table class="table table-hover  mb-0 table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <td>Mã Đơn Hàng</td>
                                                                <td>Ngày Đặt Hàng</td>
                                                                <td>Trạng Thái Thanh Toán</td>
                                                                <td>Giảm Giá</td>
                                                                <td>Tổng Cộng</td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $order->order_code}}</td>
                                                                <td>{{ date('d-m-Y' ,strtotime( $order->created_at)) }} </td>
                                                                <td>
                                                                    <span
                                                                        class="bg-{{$colorLabel[$order->status]}} label">{{$statusArray[$order->status]}}</span>
                                                                </td>
                                                                <td>
                                                                    @if($order->order_discount )
                                                                        {{number_format($order->order_discount ,0,',','.').' VNĐ' }}
                                                                    @else
                                                                        {{number_format(0 ,0,',','.').' VNĐ' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{number_format($order->total_money,0,',','.').' VNĐ' }}
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="col-form-label"><h4>Thông Tin Giao Hàng</h4></label>
                                                    <div class="table-responsive" id="ajax-queue">
                                                        <table class="table table-hover  mb-0 table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <td>Người Nhận</td>
                                                                <td>Email</td>
                                                                <td>Số Điện Thoại</td>
                                                                <td>Địa Chỉ</td>
                                                                <td>Phương Thức Thanh Toán</td>
                                                                <td>Tổng Phải Thanh Toán</td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$customer->name}}</td>
                                                                <td>{{$customer->email}}</td>
                                                                <td>{{$order->phone_number}}</td>
                                                                <td>{{$order->address}}</td>
                                                                <td>
                                                                    @if($order->payment == 0)
                                                                        Thanh toán khi nhận hàng
                                                                    @else
                                                                        Chuyển khoản
                                                                    @endif
                                                                </td>
                                                                <td>{{number_format($order->total_money)}} VNĐ</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="col-form-label">Sản Phẩm</label>
                                                    <div class="table-responsive" id="ajax-queue">
                                                        <table class="table table-hover  mb-0 table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Sản phẩm</th>
                                                                <th>Mã sản phẩm</th>
                                                                <th>Đơn giá</th>
                                                                <th>KM-Giảm giá</th>
                                                                <th>Số lượng</th>
                                                                <th>Giá sau KM</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php
                                                                $sum = 0;
                                                            @endphp
                                                            @foreach ($order->detail as $key => $item)
                                                                @php
                                                                    $product = $item->product()->first();
                                                                    $sum += $item->final_price;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $product->name }}</td>
                                                                    <td>{{ $product->sku }}</td>
                                                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                                                    <td>{{ number_format($order->order_discount) }} VNĐ</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="text-lg-left mt-3 mt-lg-0">
                                                <div class="float-left">
                                                    <p>
                                                        <span class="h3 pull-right">Tổng tiền: <span class="text-red"><strong>{{ number_format($order->total_money) }}</strong> đ</span></span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <form action="{{route('order.changeStatus')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="order" value="{{ $order->id }}">
                                                {{-- <input type="hidden" name="admin" value="1"> Thay 1 bằng id của admin --}}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Trạng thái đơn hàng: </label>
                                                            <select name="status" class="form-control" @if($order->finished_at) disabled @endif id="">
                                                                @foreach ($statusArray as $key => $status)
                                                                    <option value="{{ $key }}" {{ $order->status==$key?'selected':'' }}>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="text-center"><button type="submit" class="btn btn-success">Xác nhận</button></div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="">
                                                @if ($order->status==3)
                                                    <form action="{{route('order.complete',$order->id)}}" method="post" onsubmit="return confirm('Sau khi bấm xác nhận, đơn hàng sẽ không thể thay đổi trạng thái, bạn muốn tiếp tục?')">
                                                        @csrf
                                                        <button type="submit" class="btn bg-green pull-right">Hoàn thành đơn hàng</button>
                                                    </form>

                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                <!-- end content -->
                <!-- end page title -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
@endsection
