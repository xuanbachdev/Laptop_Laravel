<div class="header_top">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-6">
            <div class="switcher">
                <label for="">HOTLINE : <a class="link_a" href="">0987654321</a></label>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="header_links">
                <ul>
                    <li><a href="#" title="wishlist">Yêu Thích</a></li>
                    <li><a href="#" title="order tracking">Đơn Hàng</a></li>
                    <li><a href="{{route('showCart')}}" title="My cart">Giỏ Hàng</a></li>
                    @if(Auth::user())
                        <li><a href="{{route('customer.profile')}}" title="My account">Tài
                                Khoản: <span style="color: #0a90eb">{{ Auth::user()->name }}</span></a></li>
                        <li><a href="{{route('customer.logout')}}" class="logout-customer" title="Logout">Đăng xuất</a>
                        </li>
                    @else
                        <li><a href="{{route('customer.login')}}" title="Login">Đăng Nhập</a></li>
                        <li><a href="{{route('getVerificationEmail')}}" title="Login">Đăng Ký</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!--header top end-->
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row hr1">
        <div class="col-12">
            <div class="breadcrumb_content hr3">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item hr2 active">
                            Hotline: 0929690xxx
                        </div>

                        <div class="carousel-item hr2">
                            Support_email: support@gmail.com
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!--header middel-->
<div class="header_middel">
    <div class="row align-items-center">
        <!--logo start-->
        <div class="col-lg-3 col-md-3">
            <div class="logo">
                <a href="{{URL::to ('/')}}"><h2>LAPTOP STORE</h2></a>
            </div>
        </div>
        <!--logo end-->
        <div class="col-lg-9 col-md-9">
            <div class="header_right_info">
                <div class="search_bar">
                    <form action="{{route('searchProduct')}}">
{{--                        <input placeholder="Tìm Kiếm"--}}
{{--                               @if(isset($search_keyword))--}}
{{--                               value="{{ $search_keyword }}"--}}
{{--                               @endif--}}
{{--                               name="q" type="search" id="txtSearch">--}}

                        <input type="text" name="q" value="" id="txtSearch" placeholder="Tìm kiếm..." />
{{--                        <button type="submit"><i class="fa fa-search"></i></button>--}}
                        <button type="button"><i class="ion-ios-search"></i></button>
                    </form>
                </div>
                <div class="shopping_cart">
                    <!--mini cart-->
                    <div class="mini_cart" id="change-item-cart">

                            @include('layouts.clients.cart')

                        <a href="#"><i class="fa fa-shopping-cart">
                        </i>

                            @if(Session::get('cart'))
{{--                                @if(Session::get('count_cart')==0)--}}
{{--                                    {{ Session::forget('count_cart') }}--}}
{{--                                @else--}}
                                    <span id="total-quanty-show">{{ Session::get('cart')->totalQuanty }}</span>
{{--                                @endif--}}
                            @else
                                <span id="total-quanty-show">0</span>
                            @endif
{{--                        SP ---}}
{{--                        @if(Session::has('Cart') != null)--}}
{{--                              <span id="total-price-show">{{number_format(Session::get('Cart')->totalPrice)}}</span>--}}
{{--                        @else--}}
{{--                                <span id="total-price-show">0</span>--}}
{{--                            @endif--}}
{{--                        VNĐ--}}
                        <i class="fa fa-angle-down"></i></a>

                    <!--mini cart end-->
                </div>

            </div>
        </div>
    </div>
</div>
