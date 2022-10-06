@extends('layouts.master')

@section('css')
    <style>
        .products .product p.price {
            font-size: 20px !important;
        }

        .products .product span.price-through {
            text-decoration: line-through;
            font-size: 14px;
            color: red;
            padding: 0;
            margin: 0;
            line-height: 28px;

        }
    </style>
@endsection

@section('content')
    <hr class="offset-top">
    <div class="container">
    </div>

    <div class="tags">
        <div class="container">
            <div class="btn-group pull-right sorting">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <i class="ion-arrow-down-b"></i> Sắp xếp
                </button>

                <ul class="dropdown-menu">
                    {{-- <li class="active"><a href="#"> <i class="ion-arrow-down-c"></i> Theo giá tăng dần</a></li> --}}
                    <li><a href="{{ route('searchProduct') }}?sort=desc{{ $queryString }}"> <i
                                class="ion-arrow-down-c"></i> Theo
                            giá giảm dần</a></li>
                    <li><a href="{{ route('searchProduct') }}?sort=asc{{ $queryString }}"> <i
                                class="ion-arrow-up-c"></i> Theo giá
                            tăng dần</a></li>

                </ul>
            </div>

            <h1 class="h2">Danh sách sản phẩm</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Filter -->
            <div class="col-sm-4 col-md-3">
                <hr class="offset-lg">
                <form action="{{ route('searchProduct') }}?{{ $queryString }}" method="get">
                    <div class="filter">
                        <div class="item">
                            <div class="title">
                                <a href="#clear" data-action="open" class="down"> <i
                                        class="ion-android-arrow-dropdown"></i> Tùy chọn </a>
                                <a href="#clear" data-action="clear"> <i class="ion-ios-trash-outline"></i> Xóa</a>
                                <h1 class="h4">Màn hình</h1>
                            </div>

                            <div class="controls">

                                @foreach ($filters['screen'] as $item)
                                    @if (request()->query('screen'))
                                        @if (in_array($item['screen_size'], request()->query('screen')))
                                            <div class="checkbox-group" data-status="active">

                                                @else
                                                    <div class="checkbox-group" data-status="inactive">
                                                        @endif
                                                        @else
                                                            <div class="checkbox-group" data-status="inactive">
                                                                @endif

                                                                <div class="checkbox"><i class="ion-android-done"></i>
                                                                </div>
                                                                <div class="label"
                                                                     data-value="Desktops">{{ $item['screen_size'] }} in
                                                                </div>
                                                                <input type="checkbox" name="screen[]"
                                                                       @if (request()->query('screen'))
                                                                       @if (in_array($item['screen_size'], request()->query('screen'))) checked
                                                                       @endif @endif value="{{ $item['screen_size'] }}">
                                                            </div>
                                                            @endforeach
                                                    </div>
                                            </div>

                                            <br>

                                            <div class="item">
                                                <div class="title">
                                                    <a href="#clear" data-action="open" class="down"> <i
                                                            class="ion-android-arrow-dropdown"></i> Tùy
                                                        chọn</a>
                                                    <a href="#clear" data-action="clear"> <i
                                                            class="ion-ios-trash-outline"></i> Xóa</a>
                                                    <h1 class="h4">Bộ nhớ RAM</h1>
                                                </div>

                                                <div class="controls grid">

                                                    @foreach ($filters['ram'] as $item)


                                                        @if (request()->query('ram'))
                                                            @if (in_array($item['memory_capacity'], request()->query('ram')))
                                                                <div class="checkbox-group" data-status="active">

                                                                    @else
                                                                        <div class="checkbox-group"
                                                                             data-status="inactive">
                                                                            @endif
                                                                            @else
                                                                                <div class="checkbox-group"
                                                                                     data-status="inactive">
                                                                                    @endif
                                                                                    <div class="checkbox"><i
                                                                                            class="ion-android-done"></i>
                                                                                    </div>
                                                                                    <div class="label"
                                                                                         data-value="7 in">{{ $item['memory_capacity'] }}</div>
                                                                                    <input type="checkbox" name="ram[]"
                                                                                           @if (request()->query('ram'))
                                                                                           @if (in_array($item['memory_capacity'], request()->query('ram'))) checked
                                                                                           @endif @endif value="{{ $item['memory_capacity'] }}">
                                                                                </div>

                                                                                @endforeach


                                                                        </div>
                                                                </div>
                                                                <div class="item">
                                                                    <div class="title">
                                                                        <a href="#clear" data-action="open"
                                                                           class="down"> <i
                                                                                class="ion-android-arrow-dropdown"></i>
                                                                            Tùy chọn</a>
                                                                        <a href="#clear" data-action="clear"> <i
                                                                                class="ion-ios-trash-outline"></i>
                                                                            Xóa</a>
                                                                        <h1 class="h4">CPU</h1>
                                                                    </div>

                                                                    <div class="controls grid">

                                                                        @foreach ($filters['cpus'] as $item)


                                                                            @if (request()->query('cpu_id'))
                                                                                @if (in_array($item['series'], request()->query('cpu_id')))
                                                                                    <div class="checkbox-group"
                                                                                         data-status="active">

                                                                                        @else
                                                                                            <div class="checkbox-group"
                                                                                                 data-status="inactive">
                                                                                                @endif
                                                                                                @else
                                                                                                    <div
                                                                                                        class="checkbox-group"
                                                                                                        data-status="inactive">
                                                                                                        @endif
                                                                                                        <div
                                                                                                            class="checkbox">
                                                                                                            <i class="ion-android-done"></i>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="label"
                                                                                                            data-value="7 in">{{ $item['series'] }}</div>
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            name="cpu[]"
                                                                                                            @if (request()->query('cpu_id'))
                                                                                                            @if (in_array($item['series'], request()->query('cpu_id'))) checked
                                                                                                            @endif @endif value="{{ $item['series'] }}">
                                                                                                    </div>

                                                                                                    @endforeach


                                                                                            </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="item">
                                                                                        <div class="title">
                                                                                            <a href="#clear"
                                                                                               data-action="open"
                                                                                               class="down"> <i
                                                                                                    class="ion-android-arrow-dropdown"></i>
                                                                                                Tùy chọn</a>
                                                                                            <a href="#clear"
                                                                                               data-action="clear"> <i
                                                                                                    class="ion-ios-trash-outline"></i>
                                                                                                Xóa</a>
                                                                                            <h1 class="h4">Card Đồ họa
                                                                                                rời</h1>
                                                                                        </div>

                                                                                        <div class="controls grid">

                                                                                            @foreach ($filters['gpus'] as $item)


                                                                                                @if (request()->query('gpu_id'))
                                                                                                    @if (in_array($item['name'], request()->query('gpu_id')))
                                                                                                        <div
                                                                                                            class="checkbox-group"
                                                                                                            data-status="active">

                                                                                                            @else
                                                                                                                <div
                                                                                                                    class="checkbox-group"
                                                                                                                    data-status="inactive">
                                                                                                                    @endif
                                                                                                                    @else
                                                                                                                        <div
                                                                                                                            class="checkbox-group"
                                                                                                                            data-status="inactive">
                                                                                                                            @endif
                                                                                                                            <div
                                                                                                                                class="checkbox">
                                                                                                                                <i class="ion-android-done"></i>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="label"
                                                                                                                                data-value="7 in">{{ $item['name'] }}</div>
                                                                                                                            <input
                                                                                                                                type="checkbox"
                                                                                                                                name="gpu[]"
                                                                                                                                @if (request()->query('gpu_id'))
                                                                                                                                @if (in_array($item['name'], request()->query('gpu_id'))) checked
                                                                                                                                @endif @endif value="{{ $item['name'] }}">
                                                                                                                        </div>

                                                                                                                        @endforeach


                                                                                                                </div>
                                                                                                        </div>

                                                                                                        <br>
                                                                                                        <div
                                                                                                            class="item">
                                                                                                            <div
                                                                                                                class="title">
                                                                                                                <a href="#clear"
                                                                                                                   data-action="open"
                                                                                                                   class="down">
                                                                                                                    <i class="ion-android-arrow-dropdown"></i>
                                                                                                                    Tùy
                                                                                                                    chọn</a>
                                                                                                                <a href="#clear"
                                                                                                                   data-action="clear">
                                                                                                                    <i class="ion-ios-trash-outline"></i>
                                                                                                                    Xóa</a>
                                                                                                                <h1 class="h4">
                                                                                                                    Dung
                                                                                                                    lượng
                                                                                                                    SSD</h1>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="controls grid">

                                                                                                                @foreach ($filters['ssd'] as $item)


                                                                                                                    @if (request()->query('ssd'))
                                                                                                                        @if (in_array($item['ssd_capacity'], request()->query('ssd')))
                                                                                                                            <div
                                                                                                                                class="checkbox-group"
                                                                                                                                data-status="active">

                                                                                                                                @else
                                                                                                                                    <div
                                                                                                                                        class="checkbox-group"
                                                                                                                                        data-status="inactive">
                                                                                                                                        @endif
                                                                                                                                        @else
                                                                                                                                            <div
                                                                                                                                                class="checkbox-group"
                                                                                                                                                data-status="inactive">
                                                                                                                                                @endif
                                                                                                                                                <div
                                                                                                                                                    class="checkbox">
                                                                                                                                                    <i class="ion-android-done"></i>
                                                                                                                                                </div>
                                                                                                                                                <div
                                                                                                                                                    class="label"
                                                                                                                                                    data-value="7 in">{{ $item['ssd_capacity'] }}</div>
                                                                                                                                                <input
                                                                                                                                                    type="checkbox"
                                                                                                                                                    name="ssd[]"
                                                                                                                                                    @if (request()->query('ssd'))
                                                                                                                                                    @if (in_array($item['ssd_capacity'], request()->query('ssd'))) checked
                                                                                                                                                    @endif @endif value="{{ $item['ssd_capacity'] }}">
                                                                                                                                            </div>

                                                                                                                                            @endforeach


                                                                                                                                    </div>
                                                                                                                            </div>
                                                                                                                            <br>
                                                                                                                            <div
                                                                                                                                class="item">
                                                                                                                                <div
                                                                                                                                    class="title">
                                                                                                                                    <a href="#clear"
                                                                                                                                       data-action="open"
                                                                                                                                       class="down">
                                                                                                                                        <i class="ion-android-arrow-dropdown"></i>
                                                                                                                                        Mở</a>
                                                                                                                                    <a href="#clear"
                                                                                                                                       data-action="clear-price">
                                                                                                                                        <i class="ion-ios-trash-outline"></i>
                                                                                                                                        Xóa</a>
                                                                                                                                    <h1 class="h4">
                                                                                                                                        Khoảng
                                                                                                                                        giá</h1>
                                                                                                                                </div>

                                                                                                                                <div
                                                                                                                                    class="controls">
                                                                                                                                    <br>
                                                                                                                                    <div
                                                                                                                                        id="slider-price"></div>
                                                                                                                                    <br>
                                                                                                                                    <p id="amount"></p>
                                                                                                                                    <input
                                                                                                                                        type="hidden"
                                                                                                                                        id="priceLow"
                                                                                                                                        name="price[]">
                                                                                                                                    <input
                                                                                                                                        type="hidden"
                                                                                                                                        id="priceHigh"
                                                                                                                                        name="price[]">
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <br>
                                                                                                                            <div
                                                                                                                                class="item">
                                                                                                                                <div
                                                                                                                                    class="text-center">
                                                                                                                                    <button
                                                                                                                                        class="btn btn-primary">
                                                                                                                                        Lọc
                                                                                                                                    </button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <br>

                                                                                                                            {{-- Các tham số lọc --}}
                                                                                                                            {{-- category_id --}}
                                                                                                                            @if ($category_id = request()->query('category_id'))
                                                                                                                                <input
                                                                                                                                    type="hidden"
                                                                                                                                    name="category_id"
                                                                                                                                    value="{{ $category_id }}">
                                                                                                                            @endif
                                                                                                                            {{-- sort --}}
                                                                                                                            @if ($sort = request()->query('sort'))
                                                                                                                                <input
                                                                                                                                    type="hidden"
                                                                                                                                    name="sort"
                                                                                                                                    value="{{ $sort }}">
                                                                                                                            @endif
                                                                                                                            <div
                                                                                                                                class="item">
                                                                                                                                <div
                                                                                                                                    class="text-center">
                                                                                                                                    <a href="{{ route('searchProduct') }}"
                                                                                                                                       class="btn btn-danger">Hủy
                                                                                                                                        bộ
                                                                                                                                        lọc</a>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                            </div>
                </form>
            </div>
            <!-- /// -->

            <!-- Products -->
            <div class="col-sm-8 col-md-9">
                <hr class="offset-lg">

                <div class="products">
                    <div class="row">
                        @if(count($products) > 0)
                            <p class="text-center"><strong>Tìm thấy {{count($products)}} sản phẩm</strong></p>
                            @foreach ($products as $item)
                                {{-- Xử lý khuyến mãi --}}

                                <div class="col-sm-6 col-md-4 product">
                                    <div class="body">
                                        @if (Auth::check())
                                            <a href="#favorites" class="favorites" data-url="#"
                                               data-favorite="inactive"><i
                                                    class="ion-ios-heart-outline"></i></a>
                                        @endif
                                        <a href="{{ route('products.show', $item->slug) }}"><img
                                                src="{{ $item->feature_image_path }}"
                                                alt="{{ $item->name }}"/></a>

                                        <div class="content">
                                            <h1 class="h4" style="overflow: hidden;
                                                             text-overflow: ellipsis;
                                                                    display: -webkit-box;
                                                                    -webkit-line-clamp: 3; /* number of lines to show */
                                                                            line-clamp: 3;
                                                                    -webkit-box-orient: vertical;"
                                                title="{{ $item->name }}">
                                                {{ $item->name }}
                                            </h1>
                                            @if($item->sale_price)
                                                <p class="price">
                                                <span class="product-row-sale">{{number_format(($item->price * (100 - $item->sale_price))/100)}} VNĐ</span>
                                                </p>
                                            @else
                                                {{ number_format($item->price, 0, '.', '.') }} VNĐ
                                            @endif
                                            <br/>

                                            <button class="btn btn-sm btn-link"><a
                                                    href="{{ route('products.show', $item->slug) }}"> <i
                                                        class="ion-android-open"></i> Chi
                                                    tiết</a></button>

                                            <button class="btn btn-primary btn-xs rounded add_to_cart"
                                                    data-product_id="{{$item->id}}"
                                                    data-url="{{ route('addToCart', $item->id) }}"><i
                                                    class="ion-bag"></i>
                                                Thêm vào giỏ
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <p class="text-center">Tìm thấy 0 sản phẩm</p>
                        @endif
                    </div>
                    <nav>
                        {!! $products->links() !!}
                    </nav>
                </div>
                <!-- /// -->
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('.filter a[data-action="clear-price"]').on('click', function () {

            $(".filter #slider-price").slider({
                values: [5000000, 50000000]
            });

            // $(".filter #amount").html($(".filter #slider-price").slider("values", 0) + " đ - " +
            //     $(".filter #slider-price").slider("values", 1) + " đ");


            //customize code
            $(".filter #amount").html(parseInt($(".filter #slider-price").slider("values", 0)).toLocaleString(
                    'en-ES') + " đ - " +
                parseInt($(".filter #slider-price").slider("values", 1)).toLocaleString('en-ES') + " đ");

            $('#priceLow').val($(".filter #slider-price").slider("values", 0));
            $('#priceHigh').val($(".filter #slider-price").slider("values", 1));
            // end customize code

        });

        if ($("body").find('.filter').length > 0) {
            $(".filter #slider-price").slider({
                range: true,
                min: 0,
                max: 100000000,
                // customize code
                step: 100000,
                //xử lí giá trị cũ
                @php
                    $oldPrice = request() -> query('price');
                @endphp

                    @if ($oldPrice && $oldPrice[0] && $oldPrice[1])

                values: [{{ $oldPrice[0] }}, { {$oldPrice[1]}
            }
        ],

            @else

                values: [5000000, 50000000],

                @endif

                // endcustomize code
                slide
        :

            function (event, ui) {
                // $("#amount").html(ui.values[0] + " đ - " + ui.values[1] + " đ");

                // customize code
                $("#amount").html(parseInt(ui.values[0]).toLocaleString('en-ES') + " đ - " + parseInt(ui
                    .values[1]).toLocaleString('en-ES') + " đ");
                $('#priceLow').val(ui.values[0]);
                $('#priceHigh').val(ui.values[1]);
                console.log($('#priceLow').val(), $('#priceHigh').val());
                // end customize code
            }
        })
            ;

            // $(".filter #amount").html($("#slider-price").slider("values", 0) + " đ - " +
            //     $("#slider-price").slider("values", 1) + " đ");

            // customize code
            $(".filter #amount").html(parseInt($(".filter #slider-price").slider("values", 0)).toLocaleString('en-ES') +
                " đ - " +
                parseInt($(".filter #slider-price").slider("values", 1)).toLocaleString('en-ES') + " đ");
            // end customize code

        }
        //Slider price
    </script>
@endsection
