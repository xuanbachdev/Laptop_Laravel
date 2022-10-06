<div class="header_bottom">
    <div class="row">
        <div class="col-12">
            <div class="main_menu_inner">
                <div class="main_menu d-none d-lg-block">
                    <nav>
                        <ul>
                            <li class="active"><a href="/">Trang Chủ</a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="#">Mua Hàng</a>--}}
{{--                            </li>--}}
                            <li><a href="#">Sản phẩm</a>
                                <div class="mega_menu">
                                    <div class="mega_top fix">

                                        <div class="mega_items">
                                            <h3><a href="#">Danh mục sản phẩm</a></h3>
                                            <ul class="nav navbar-nav">
                                                @foreach($categorysLimit as $categoryParent)
                                                    <li class="dropdown"><a href="{{route('product.category', ['slug' => $categoryParent->slug, 'id' => $categoryParent->id])}}">
                                                            {{ $categoryParent->name }}
                                                        </a>
{{--                                                        <i class="fa fa-angle-down"></i></a>--}}
                                                        @if($categoryParent->childCategory->count())
                                                            <ul class="dropdown-menu">
                                                                @foreach($categoryParent->childCategory as $categoryChild)
                                                                    <li><a href="{{route('product.category', ['slug' => $categoryChild->slug, 'id' => $categoryChild->id])}}">{{ $categoryChild->name }}</a></li>
                                                                    @if($categoryChild->childCategory->count())
                                                                        @include('client.home', ['categoryParent' => $categoryChild])
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </li>

                            <li>
                                <a href="{{route('home.blog')}}">Bài viết</a>
                            </li>
                            <li>
                                <a href="{{route('customer.contact')}}">Liên hệ</a>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="mobile-menu d-lg-none">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{URL::to ('/')}}"><h5> Home</h5></a>
                            </li>
                            <li>
                                <a href="{{URL::to ('/shop-now')}}"><h5>shop now</h5></a>
                            </li>
                            <li><a href=""><h5>PAGES </h5></a></li>
                            <div>

                                <li>
                                    <a href="#">Danh mục Phẩm</a>
                                    <ul>
                                        <li><a href="">LaptopDell</a></li>
                                        <li><a href="">LaptopAsus</a></li>
                                    </ul>
                                </li>
                            </div>
                            <li>
                                <a href="{{URL::to ('/promotion')}}"><h5>Khuyến Mãi</h5></a>
                            </li>
                            <li>
                                <a href="{{URL::to ('/about-us')}}">Cửa Hàng</a>
                            </li>
                            <li>
                                <a href="{{URL::to ('/countdown')}}">Năm Mới 2022</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
