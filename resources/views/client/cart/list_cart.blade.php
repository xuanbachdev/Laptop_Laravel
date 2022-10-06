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
                        <td class="product_quantity"><input class="quantity"
                                                            id="quanty-item-{{$item['productInfo']->id}}" min="1"
                                                            name="cart_quantity[{{$item['session_id']}}]"
                                                            value="{{ $item['quanty'] }}" type="number">
                        </td>
                        <td class="product_total">{{number_format( $item['price'] * $item['quanty'] ,0,',','.').' VNĐ' }}</td>
                        <td class="close-td first-row">
                            <a href="#" id="quanty-item-{{$item['productInfo']->id}}"
                               onclick="updateListItemCart({{$item['productInfo']->id}});"
                               class="btn btn-outline-success update_cart" type="button">
                                <i class="fa fa-save"></i>
                            </a>
                        </td>
                        <td class="product_remove">

                            <a href="" data-id_product="{{ $item['session_id']}}"
                               data-url="{{route('deleteCart'), $id}}" data-id="{{$id}}"
                               class="btn btn-outline-danger cart_delete"
                               type="button"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
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
        {{--                        @if(Session::get('cart')==true)--}}
        {{--                            --}}{{--                        <a type="button" class="btn btn-danger mr-2" href="{{ URL::to('/shop-now')}}">Mua Hàng</a>--}}
        {{--                            <button type="button" data-url="" data-id="">Cập Nhật Giỏ Hàng</button>--}}
        {{--                        @endif--}}
    </div>
</div>
