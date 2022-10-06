@extends('layouts.master')

@section('content')
<div id="wrapper_content">
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Giỏ Hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--shopping cart area start -->
    @include('errors.check_error')
    <div class="shopping_cart_area">

{{--        <form action="" method="POSt">--}}
{{--            @csrf--}}
            <div class="row">
                <div class="col-lg-12" id="list-cart">
                    <div class="table_cart">
                        <div class="cart_page table-responsive">
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th class="product_thumb">Ảnh</th>
                                    <th class="product_name">Tên Sản Phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product_quantity">Số Lượng</th>
                                    <th class="product_total">Tổng Tiền</th>
                                    <th class="product_total" colspan="2">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Session::get('cart')==true)
                                    @php
                                        $subtotal=0;
                                        $cart = Session::get('cart');
                                    @endphp

                                    @foreach (Session::get('cart')->products as $id => $item)
                                        <form action="{{route('updateCart', ['id' => $item['product_id'], 'quanty'=> $item['quanty']])}}" method="post">
                                            @csrf
                                        @php
                                            $subtotal += $item['price']*$item['quanty'];
                                        @endphp
                                        <tr>
                                            <input type="hidden" name="product_session_id[{{ $item['productInfo']->id }}]"
                                                   class="product_session_id_{{ $item['session_id'] }}"
                                                   value="{{ $item['session_id'] }}">
                                            <input type="hidden" id="pro_quantity" value="{{$item['productInfo']->quantity}}">
                                            <td class="product_thumb"><a href="#"><img
                                                        src="{{$item['productInfo']->feature_image_path}}" width="70px"
                                                        height="75px"
                                                        alt=""></a></td>
                                            <td class="product_name"><a href="#">{{ $item['productInfo']->name }}</a></td>
                                            <td class="product-price">{{number_format($item['price']  ,0,',','.').' VNĐ' }}</td>
                                            <td class="product_quantity"><input class="quantity" min="1" id="quanty-item-{{$item['productInfo']->id}}"
                                                                                name="cart_quantity[{{$item['session_id']}}]"
                                                                                value="{{ $item['quanty'] }}"
                                                                                type="number">
                                            </td>
                                            <td class="product_total">{{number_format( $item['price'] * $item['quanty'] ,0,',','.').' VNĐ' }}</td>
                                            <td class="close-td first-row">

                                                    <button href=""   class="btn btn-outline-success" type="submit">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                            </td>
                                            <td class="product_remove">

                                                <a href="" data-id_product="{{ $item['session_id']}}"
                                                   data-url="{{route('deleteCart', $item['product_id'])}}" data-id="{{$id}}"
                                                   class="btn btn-outline-danger cart_delete"
                                                   type="button"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="6"><h4 style="text-align: center">Không có sản phẩm nào trong giỏ
                                                hàng!</h4>
                                            <a type="button" class="btn btn-danger" href="{{route('home.index')}}">Mua
                                                Hàng</a>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            @if(Session::get('cart')==true)
{{--                                <a type="button" class="btn btn-danger mr-2" href="{{ URL::to('/shop-now')}}">Mua--}}
{{--                                    Hàng</a>--}}
{{--                                <button type="submit" data-url="" data-id="">Cập Nhật Giỏ Hàng</button>--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
{{--        </form>--}}
        <!--coupon code area start-->
        <div class="coupon_area">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code">
                        <h3>Mã Giảm Giá</h3>
                        @if(Session::get('cart'))
                            @if(Auth::check())
                                <form action="{{ URL::to('/check-coupon')}}" method="POST">
                                    @csrf
                                    <div class="coupon_inner">
                                        <p>Nhập mã giảm giá, nếu có.</p>
                                        <input placeholder="Coupon code" required="Vui lòng nhập mã giảm giá(nếu có)"
                                               name="cart_coupon" type="text">
                                        <button type="submit" class="check-coupon">Thêm Mã Khuyến Mãi</button>
                                        @if(Session::get('coupon'))
                                            <a type="button" class="check-coupon btn btn-danger pull-right"
                                               href="{{ URL::to('/delete-coupon-cart')}}">Xóa
                                                Mã Khuyến Mãi
                                            </a>
                                        @endif
                                    </div>

                                </form>
                            @else
                                <h4 style="text-align: center">Vui lòng đăng nhập để sử dụng mã giảm giá!</h4>
                            @endif
                        @else
                            <h4 style="text-align: center">Không có!</h4>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code">
                        <h3>Tổng Giỏ Hàng</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Tổng</p>
                                <p class="cart_amount">
                                    @if(Session::get('cart')==true)
                                        {{number_format($subtotal,0,',','.').' VNĐ' }}
                                    @else
                                        {{number_format(0,0,',','.').' VNĐ' }}
                                    @endif
                                </p>
                            </div>
                            <div class="cart_subtotal ">
                                <p>Khuyến mãi</p>
                                <p class="cart_amount">
                                    @if(Session::get('cart')==true)
                                        @if(Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key=>$cou)
                                                @if($cou['coupon_type']==0)
                                                    {{ $cou['coupon_percent'] }} % (
                                                    - {{ number_format( $subtotal*($cou['coupon_percent'] ) / 100 ) . ' VNĐ '}}
                                                    )
                                                    @php
                                                        $total_coupon =$subtotal- (($subtotal*$cou['coupon_percent'])/100);
                                                    @endphp
                                                @else
                                                    {{number_format( $cou['coupon_amount'],0,',','.').' VNĐ' }}
                                                    @php
                                                        $total_coupon =$subtotal-$cou['coupon_amount'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{--                                {{number_format($total_coupon,0,',','.').' VNĐ' }}--}}
                                        @else
                                            Không có
                                        @endif

                                    @endif
                                </p>
                            </div>
                            <div class="cart_subtotal">
                                <p>Tổng tiền</p>
                                <p class="cart_amount">
                                    @if(Session::get('cart')==true)
                                    @if(Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key=>$cou)
                                    @if($cou['coupon_type']==0)
                                    @php
                                        $total_coupon =$subtotal- (($subtotal*$cou['coupon_percent'])/100);
                                    @endphp

                                    @else
                                    @php
                                        $total_coupon =$subtotal-$cou['coupon_amount'];
                                    @endphp
                                    @endif
                                    @endforeach
                                    </span>
                                    {{number_format($total_coupon,0,',','.').' VNĐ' }}
                                    @else
                                        {{number_format($subtotal,0,',','.').' VNĐ' }}
                                    @endif
                                </p>
                            </div>
                            <div class="checkout_btn">
                                @if(Auth::check())
                                    <a href="{{ URL::to('/checkout')}}">Thanh Toán</a>
                                @else
                                    <a href="{{ URL::to('/login-customer')}}">Thanh Toán</a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--coupon code area end-->

    </div>

    <!--shopping cart area end -->
</div>
@endsection
