@if(Session::get('cart')==true)
    @php
        $subtotal=0;
        $cart = Session::get('cart');
    @endphp

    @foreach(Session::get('cart')->products as $cartItems)
        @php
            $subtotal+=$cartItems['price']*$cartItems['quanty'];
        @endphp
        <div class="cart_item">
            <div class="cart_img">
                <a href="#"><img src="{{$cartItems['productInfo']->feature_image_path}}" alt=""></a>
            </div>
            <div class="cart_info">
                <a href="#">{{$cartItems['productInfo']->name}}</a>
                <span class="cart_price">{{number_format($cartItems['price'])}} VNĐ</span>
{{--                <span class="quantity">Số Lượng: <input class="input-text cart-qty qty" maxlength="12" type="number"  title="Số lượng" size="4" value="{{$cartItems['quantity']}}" name="qty"> </span>--}}
                <span class="quantity">Số Lượng: {{$cartItems['quanty']}}  </span>
            </div>
            <div class="cart_remove">
{{--                <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>--}}
            </div>
        </div>
    @endforeach
@else
    <h5 style="text-align: center">Không có sản phẩm nào trong giỏ hàng!</h5>
@endif

<div class="total_price">
    <h5>Tổng tiền </h5>
    <span class="prices">
         @if(Session::get('cart'))
            <h5>{{number_format($subtotal)}} VNĐ</h5>
            <input hidden id="total-quanty-cart" type="number" value="{{ Session::get('cart')->totalQuanty }}">
{{--            <input hidden id="total-price-cart" type="number" value="{{$subtotal}}">--}}
        @endif
    </span>
</div>
<div class="cart_button">
    <a href="{{route('showCart')}}">Giỏ Hàng</a>
</div>
</div>
