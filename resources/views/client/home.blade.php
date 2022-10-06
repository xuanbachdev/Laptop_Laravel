@extends('layouts.master')

@section('content')
    @include('layouts.clients.slider')
    <header>
        <section class='products'>
            <div class='container'>
                {{--                <div class='block_title'>--}}
                <h2 class='product-group-tittle text-center'> Laptop mới </h2>
                {{--                </div>--}}
                <hr class='offset-lg'>
                <div class='row'>

                    @foreach ($new_product as $item)
                        <div class='col-sm-6 col-md-3 product'>
                            <div class='body'>
                                @if (Auth::check())
                                    <a href='#favorites' data-url='' class='favorites' data-favorite='inactive'><i
                                            class='ion-ios-heart-outline'></i></a>
                                @endif

                                <a href=''><img src='{{ $item->feature_image_path }}'
                                                alt='{{ $item->name }}'/></a>

                                <div class='content align-center product_info'>
                                    <div class='product-row-price'>
                                        @if($item->sale_price)
                                            <del>{{ number_format($item->price, 0, '.', '.') }} VNĐ</del>
                                        @else
                                            <del></del>
                                        @endif
                                        <br>
                                        <span class='product-row-sale'>{{number_format(($item->price * (100 - $item->sale_price))/100)}} VNĐ</span>
                                    </div>

                                    <h2 class='h3' style='overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 2; /* number of lines to show */
                                        line-clamp: 2;
                                -webkit-box-orient: vertical;' title='{{ $item->name }}'>{{ $item->name }}</h2>

                                    <hr class='offset-sm'>

                                    <a href='{{route('products.show', $item->slug)}}'
                                       class='btn btn-warning views-product-detail mb-2'><i
                                            class='ion-android-open'></i> Chi tiết sản phẩm
                                    </a>

                                        <a href="#" class='btn btn-primary add_to_cart' data-id="{{$item->id}}"
                                           data-url='{{route('addToCart',['id' => $item->id ])}}'><i
                                                class='ion-bag'></i> Thêm vào giỏ hàng
                                        </a>

                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class='col-md-12'>
                        {{$new_product->links()}}
                    </div>
                </div>
                {{--            <div class='align-right align-center-xs'>--}}
                {{--                <hr class='offset-sm'>--}}
                {{--                <a href=''>--}}
                {{--                    <h5 class='upp'>Xem tất cả laptop </h5>--}}
                {{--                </a>--}}
                {{--            </div>--}}
            </div>
        </section>
    </header>
    <header>
        <section class='products'>
            <div class='container'>
                {{--                <div class='block_title'>--}}
                <h2 class='product-group-tittle text-center'> Laptop nổi bật </h2>
                {{--                </div>--}}
                <hr class='offset-lg'>
                <div class='row'>

                    @foreach ($highlight as $item)
                        <div class='col-sm-6 col-md-3 product'>
                            <div class='body'>
                                @if (Auth::check())
                                    <a href='#favorites' data-url='' class='favorites' data-favorite='inactive'><i
                                            class='ion-ios-heart-outline'></i></a>
                                @endif

                                <a href=''><img src='{{ $item->feature_image_path }}'
                                                alt='{{ $item->name }}'/></a>

                                <div class='content align-center product_info'>
                                    <div class='product-row-price'>
                                        @if($item->sale_price)
                                            <del>{{ number_format($item->price, 0, '.', '.') }} VNĐ</del>
                                        @else
                                            <del></del>
                                        @endif
                                        <br>
                                        <span class='product-row-sale'>{{number_format(($item->price * (100 - $item->sale_price))/100)}} VNĐ</span>
                                    </div>

                                    <h2 class='h3' style='overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 2; /* number of lines to show */
                                        line-clamp: 2;
                                -webkit-box-orient: vertical;' title='{{ $item->name }}'>{{ $item->name }}</h2>

                                    <hr class='offset-sm'>

                                    <a href='{{route('products.show', $item->slug)}}'
                                       class='btn btn-warning views-product-detail mb-2'><i
                                            class='ion-android-open'></i> Chi tiết sản phẩm
                                    </a>

                                    <a href="#" class='btn btn-primary add_to_cart'
                                       data-url='{{route('addToCart',['id' => $item->id ])}}'><i
                                            class='ion-bag'></i> Thêm vào giỏ hàng
                                    </a>

                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class='col-md-12'>
                        {{$new_product->links()}}
                    </div>
                </div>
                {{--            <div class='align-right align-center-xs'>--}}
                {{--                <hr class='offset-sm'>--}}
                {{--                <a href=''>--}}
                {{--                    <h5 class='upp'>Xem tất cả laptop </h5>--}}
                {{--                </a>--}}
                {{--            </div>--}}
            </div>
        </section>
    </header>

@stop


@section('js')

@endsection
