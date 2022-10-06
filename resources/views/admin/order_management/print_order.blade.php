@extends('layouts.admin')

@section('css')
    <style>
        span{
            font-size: 24px;
        }
    </style>
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="cart">
                    <div class="card-title text-center">
                        <div class="row">
                            <div class="col col-1">

                            </div>
                            <div class="col col-3 ">
                                <img src="" class="image-logo">
                            </div>
                            <div class="col col-8">
                                <h1>Cừa hàng Laptop vip</h1>
                                <h3>Địa chỉ: Đống Đa, Hà Nội</h3>
                                <h3>Hotline: 19001258</h3>
                                <h3>Email: contact@gmail.com</h3>
                            </div>

                        </div>

                        <br>
                        <h2><b>HÓA ĐƠN THANH TOÁN</b></h2>
                    </div>
                    <div class="card-body text-left">
                        <span>Mã đơn hàng: </span>
                        <span> {{$order->order_code}}  </span>
                        <br>
                        <span>Tên khách hàng: </span>
                        <span> {{$order->customer()->first()->name}}  </span>
                        <br>
                        <span>Số điện thoại: </span>
                        <span> {{$order->phone_number}} </span>
                        <br>
                        <span>Địa chỉ: </span>
                        <span>  {{$order->address}} </span>
                        <br>
                        <span>Ghi Chú: </span>
                        <span> {{$order->note}}  </span>
                    </div>
                </div>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
{{--                        <th>Chiết khấu</th>--}}
{{--                        <th>Tổng cộng</th>--}}
{{--                        <th>Tổng phải thanh toán</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $sum = 0;
                        $i = 1;
                        $totalQuanty = 0;
                    @endphp
                    @foreach ($order->detail as $key => $item)
                        @php
                            $product = $item->product()->first();
                            $sum += $item->final_price;
                            $totalQuanty += $item->quantity;
                        @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ number_format($item->price) }} VNĐ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->final_price) }} VNĐ</td>
{{--                            <td>--}}
{{--                                @if($order_coupon)--}}
{{--                                    @if($order_coupon->type == 1)--}}
{{--                                        {{number_format($order_coupon->discount_amount). ' VNĐ'}}--}}
{{--                                    @else--}}
{{--                                        {{number_format($order_coupon->discount_percent). ' %'}}--}}
{{--                                    @endif--}}
{{--                                @else--}}
{{--                                    {{number_format($order->order_discount). ' VNĐ'}}--}}
{{--                                @endif--}}

{{--                                @if($order->order_discount )--}}
{{--                                    {{number_format($order->order_discount ,0,',','.').' VNĐ' }}--}}
{{--                                @else--}}
{{--                                    {{number_format(0 ,0,',','.').' VNĐ' }}--}}
{{--                                @endif--}}

{{--                            </td>--}}
{{--                            <td>{{ number_format($order->total_money) }} VNĐ</td>--}}
{{--                            <td>{{ number_format($order->total_money) }} VNĐ</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <tfoot>
                <table class="table table-bordered table-condensed total-result">
{{--                    <tr>--}}
{{--                        <td><b> Tổng số lượng:</b></td>--}}
{{--                        <td>--}}
{{--                            {{number_format($totalQuanty)}}--}}
{{--                        </td>--}}
{{--                    </tr>--}}

                    <tr>
                        <td><b> Chiết Khấu:</b></td>
                        <td>
                            {{number_format($order->order_discount)}} VMĐ
                        </td>
                    </tr>

                    <tr>
                        <td><b>Tổng tiền phải thanh toán:</b></td>
                        <td>
                            <span class="text-red"><strong> {{ number_format($order->total_money) }} VNĐ</strong></span>
                        </td>
                    </tr>

                <tr>
                </tr>
                </table>

                </tfoot>
            </div>

        </div>
    </div>
@endsection

