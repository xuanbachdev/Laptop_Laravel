@extends('layouts.master')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Trang Chủ</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Chi Tiết Sản Phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product wrapper start-->
    <div class="product_details video_details">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="product_tab product_video fix">
                    <div class="tab-content produc_tab_c">
                        <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                            <div class="modal_img">
                                <div class="col-sm-12 col-md-12 white no-padding">
                                    @php
                                        $productImages = $products->productImage;
                                        $imageCount = count($productImages);
                                    @endphp
                                    @if($imageCount > 0)
                                        <div class="carousel-product modal_img" data-count="{{ $imageCount }}"
                                             data-current="1">
                                            <div class="items">
                                                <button class="btn btn-control" data-direction="right"><i
                                                        class="ion-ios-arrow-right"></i></button>
                                                <button class="btn btn-control" data-direction="left"><i
                                                        class="ion-ios-arrow-left"></i></button>

                                                @foreach ($productImages as $key => $item)
                                                    <div class="item{{ $key == 0 ? ' center' : '' }}"
                                                         data-marker="{{ $key + 1 }}">
                                                        <img src="{{ $item->image_path }}" alt="{{ $products->name }}"
                                                             class="background"/>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <ul class="markers modal_img">
                                                @for ($i = 1; $i <= $imageCount; $i++)
                                                    <li data-marker="{{ $i }}" {{ $i == 1 ? 'class=active' : '' }}></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    @else
                                        <div class="carousel-product modal_img" data-count="1"
                                             data-current="1">
                                            <div class="items">
                                                @php
                                                    $key=0;
                                                @endphp
                                                <div class="item{{ $key == 0 ? ' center' : '' }}"
                                                     data-marker="{{ $key + 1 }}">
                                                    <img src="{{ $products->feature_image_path }}"
                                                         alt="{{ $products->name }}"
                                                         class="background"/>
                                                </div>
                                            </div>

                                            <ul class="markers modal_img">
                                                @for ($i = 1; $i <= $imageCount; $i++)
                                                    <li data-marker="{{ $i }}" {{ $i == 1 ? 'class=active' : '' }}></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    @endif
                                    @foreach ($productImages as $key => $item)
                                        <div class="view_img">
                                            <a class="large_view" href="{{ $item->image_path }}"><i
                                                    class="fa fa-search-plus"></i></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_tab_button">
                        <ul class="nav" role="tablist">
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="product_d_right ">
                    <h1>{{$products->name}}</h1>
                    <div class="short_desc motangan full">
                        <div class="motangan_title">Thông số tóm tắt</div>
                        <div class="motangan_content">
                            <ul>
                                <li>Bộ xử lý CPU: 11th Generation Intel® Core™ i5-1135G7 Processor (8MB Cache, up to 4.2
                                    GHz)
                                </li>
                                <li>Bộ nhớ RAM: 8GB 4267MHz LPDDR4x Memory Onboard</li>
                                <li>Ổ cứng: 512GB M.2 PCIe NVMe Solid State Drive</li>
                                <li>Màn hình: 13.3" FHD (1920 x 1080) InfinityEdge Non-Touch display</li>
                                <li>Card màn hình: Intel® Iris Xe Graphics</li>
                            </ul>
                        </div>
                    </div>
                    {{--                    <div class="product_ratting mb-10">--}}
                    {{--                        <div id="rateYo"></div>--}}
                    {{--                        <ul>--}}

                    {{--                            <input type="hidden" value="0" id="average_rating">--}}
                    {{--                            <input type="hidden" value="0" id="count_rate">--}}
                    {{--                            <li><a href="#"> số lượt đánh giá : <span>0</span> <h4>0 Điểm</h4></a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}


                    <div class="product_desc">
                        <p>...</p>
                    </div>

                    <div class="content_price mb-15 ">
                        <div class="product-row-price">
                           <span class="product-row-sale">
                                @if($products->sale_price)
                                   <span class="product-row-sale">{{number_format(($products->price * (100 - $products->sale_price))/100)}} VNĐ</span>
                               @else
                                   {{ number_format($products->price, 0, '.', '.') }} VNĐ
                               @endif
                           </span>
                        </div>
                    </div>
                    <form>
                        @csrf
                        <div class="box_quantity mb-20 ">

                            <button type="button" data-product_id="{{$products->id}}" class="add_to_cart"
                                    data-url="{{route('addToCart',$products->id)}}"><i
                                    class="fa fa-shopping-cart"></i> Thêm vào giỏ
                            </button>

                            {{--                            <a href="javascript:" onclick="AddCart({{$products->id}})" data-url="{{route('add.shopping.cart',$products->id)}}">Thêm giỏ hàng</a>--}}
                            {{--                            <a type="button" onclick="add_wistlist(this.id);" id="125" title="add to wishlist"><i--}}
                            {{--                                    class="fa fa-heart" aria-hidden="true"></i></a>--}}
                        </div>
                    </form>

                    {{--                    <a href="{{route('add.shopping.cart',$products->id)}}" class="btn btn-primary mb-5 ">Thêm giỏ hàng</a>--}}
                    <div class="product_stock mb-20">
                        <p>{{$products->quantity}} sản phẩm</p>
                        <span>Trong kho</span>
                    </div>
{{--                    <div class="container rating-a">--}}
{{--                        <div class="inner">--}}
{{--                            <div class="rating">--}}
{{--                                <span class="rating-num">0 </span>--}}

{{--                                <div id="ratetotal"></div>--}}
{{--                                <div class="rating-users">--}}
{{--                                    <i class="icon-user"></i> 0 Lượt đánh giá--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="histo">--}}
{{--                                <div class="five histo-rate">--}}
{{--                              <span class="histo-star">--}}
{{--                                <i class="active fa fa-star ratting_review"></i>   5    </span>--}}
{{--                                    <span class="bar-block">--}}
{{--                                <span id="bar-five" class="bar">--}}
{{--                                  <span>--}}
{{--                                                                           0--}}
{{--                                       <input type="hidden" id="rating-5-star" value="0">--}}
{{--                                                                    </span>&nbsp;--}}
{{--                                </span>--}}
{{--                              </span>--}}
{{--                                </div>--}}

{{--                                <div class="four histo-rate">--}}
{{--                              <span class="histo-star">--}}
{{--                                <i class="active fa fa-star ratting_review"></i>   4    </span>--}}
{{--                                    <span class="bar-block">--}}
{{--                                <span id="bar-four" class="bar">--}}
{{--                                  <span>--}}
{{--                                                                        0--}}
{{--                                    <input type="hidden" id="rating-4-star" value="0">--}}
{{--                                                                    </span>&nbsp;--}}
{{--                                </span>--}}
{{--                              </span>--}}
{{--                                </div>--}}

{{--                                <div class="three histo-rate">--}}
{{--                              <span class="histo-star">--}}
{{--                                <i class="active fa fa-star ratting_review"></i>   3    </span>--}}
{{--                                    <span class="bar-block">--}}
{{--                                <span id="bar-three" class="bar">--}}
{{--                                <span>--}}
{{--                                    <input type="hidden" id="rating-3-star" value="0">--}}
{{--                                </span>&nbsp;--}}
{{--                                </span>--}}
{{--                              </span>--}}
{{--                                </div>--}}

{{--                                <div class="two histo-rate">--}}
{{--                              <span class="histo-star">--}}
{{--                                <i class="active fa fa-star ratting_review"></i>   2    </span>--}}
{{--                                    <span class="bar-block">--}}
{{--                                <span id="bar-two" class="bar">--}}
{{--                                  <span>--}}
{{--                                                                        0--}}
{{--                                    <input type="hidden" id="rating-2-star" value="0">--}}
{{--                                                                    </span>&nbsp;--}}
{{--                                </span>--}}
{{--                              </span>--}}
{{--                                </div>--}}

{{--                                <div class="one histo-rate">--}}
{{--                              <span class="histo-star">--}}
{{--                                <i class="active fa fa-star ratting_review"></i>   1    </span>--}}
{{--                                    <span class="bar-block">--}}
{{--                                <span id="bar-one" class="bar">--}}
{{--                                  <span>--}}
{{--                                                                        0--}}
{{--                                    <input type="hidden" id="rating-1-star" value="0">--}}
{{--                                                                    </span>&nbsp;--}}

{{--                                </span>--}}
{{--                              </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                   aria-selected="false">Thông tin sản phẩm</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Mô
                                    Tả</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                   aria-selected="false">Đánh giá</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane " id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p> {!! $products->description !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="sheet" role="tabpanel">
                            <div class="product_d_table">
                                @php
                                    $cpu = $products->cpu()->first();
                                    $gpu = $products->gpu()->first();
                                @endphp
                                <form action="#">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="first_child">Hệ điều hành theo máy</td>
                                            <td>{{$products->operating_system}}</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Màn hình</td>
                                            <td>
                                                <p>
                                                    Loại màn hình: {{ $products->screen_type }}<br>
                                                    Kích thước: {{ $products->screen_size }} inches <br>
                                                    Chi tiết: {{ $products->screen_detail }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Vi xử lý</td>
                                            <td>
                                                Xung nhịp cơ bản: {{ $cpu->base_clock }} <br>
                                                Xung nhịp turbo: {{ $cpu->turbo_clock }} <br>
                                                Bộ nhớ đệm: {{ $cpu->cache }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Đồ họa</td>
                                            <td>
                                                <p>
                                                    Đồ họa tích hợp: {{ $cpu->intergrated_gpu }}
                                                    @if ($gpu)
                                                        <br>
                                                        Đồ họa
                                                        rời: {{ "$gpu->brand $gpu->series $gpu->name, $gpu->clock" }}.
                                                        <br>
                                                        Mô tả: {{ $gpu->addition }}
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Bộ nhớ ram</td>
                                            <td>
                                                <p>
                                                    Số khe RAM: {{ $products->memory_slots }} <br>
                                                    Loại RAM: {{ $products->memory_type }} <br>
                                                    Dung lượng: {{ $products->memory_capacity }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Ổ cứng</td>
                                            <td>
                                                <p>
                                                    SSD: {{ $products->ssd_storage }} <br>
                                                    Dung lượng SSD: {{ $products->ssd_capacity }} <br>
                                                    HDD: {{ $products->hdd_storage }} <br>
                                                    Dung lượng HDD: {{ $products->hdd_capacity }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Kết nối không dây</td>
                                            <td>
                                                <p>
                                                    Wi-Fi: {{ $products->wifi }}<br>
                                                    Bluetooth: {{ $products->bluetooth }}<br>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Cổng kết nối</td>
                                            <td>
                                                <p>
                                                    {!! str_replace(', ', '<br>', $products->connection_port) !!}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Bàn phím</td>
                                            <td>
                                                <p>{{ $products->keyboard }}</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Đặc điểm khác</td>
                                            <td>
                                                <p>{{ $products->addition }}</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Vỏ</td>
                                            <td>
                                                <p>Chất liệu: {{ $products->case_material }}
                                                    <br>
                                                    Màu: {{ $products->color }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="first_child">Pin</td>
                                            <td>
                                                <p>{{ $products->battery }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="product_info_content">
                                <p> {{ $products->descriptiomn }}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="reviews" role="tabpanel">
                            <div class="product_info_content">
                                <p> {{ $products->descriptiomn }}</p>
                            </div>
                            <form action="{{route('customer.comment')}}" method="POST">
                                @csrf
                                <div class="product_review_form rmp">
                                    <h2>Thêm đánh giá của bạn</h2>
                                    <p>Đánh giá mức độ hài lòng của bạn </p>
                                    <div class="product_ratting mb-10 rps">
                                        <i class="fa fa-star" data-index="0" style="display:none"></i>
                                        <i class="fa fa-star" data-index="1"></i>
                                        <i class="fa fa-star" data-index="2"></i>
                                        <i class="fa fa-star" data-index="3"></i>
                                        <i class="fa fa-star" data-index="4"></i>
                                        <i class="fa fa-star" data-index="5"></i>
                                    </div>
                                    <input type="hidden" value="" required="" class="starRateV" name="starRateV">
                                    <input type="hidden" value="{{ $products->id }}" name="product_id"
                                           class="product_id">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <label for="author">Tên</label>
                                            <input id="review-name" class="review_name" name="review_name" value="@if(Auth::check()) {{Auth::user()->name}} @else ''  @endif" type="text">
                                            @error('review_name')
                                            <p class="alert alert-danger"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="review_comment">Nội dung đánh giá </label>
                                            <textarea name="review_comment" class="review_comment"
                                                      id="review-comment"></textarea>
                                            @error('review_comment')
                                            <p class="alert alert-danger"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="rate-error" align="center"></div>
                                    </div>
                                    <button type="submit">Gửi</button>
                                </div>
                            </form>
                            <hr>
                            <form>
                                @csrf
                                <input type="hidden" name="comment_product_id" class="comment_product_id"
                                       value="{{$products->id}}">
                                <div id="comment_show">
                                    @foreach ($comment_customer as $key=>$comment )
                                        <div class="product_info_inner ">
                                            <div class="product_ratting mb-10 col-md-6">
                                                <div class="col-md-2">
                                                    <img width="100%" src="{{asset(Auth::user()->avatar_path)}}" class="img img-responsive img-thumbnail comment-img">
                                                </div>
                                                <br>
                                                <div col-md-4>
                                                    <ul>
                                                        @for($count = 1; $count <=5; $count++)
                                                            @if($count <= $comment->points)
                                                                <i class="fa fa-star ratting_review"></i>
                                                            @else
                                                                <i class="fa fa-star ratting_no_review"></i>
                                                            @endif
                                                        @endfor
                                                    </ul>
                                                    <strong>{{ $comment->name }}</strong>
                                                    <p>{{ $comment->created_at }}</p>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                            &emsp;&emsp;
                                            @foreach ($comment_admin as $k=>$ad_comment)
                                                @if($ad_comment->feedback==$comment->id)
                                                    <div class="col-md-6">
                                                        <div class="product_demo">
                                                            <div class="col-md-2">
                                                                <img width="70%" src="{{URL::asset('/backend/images/users/SHOES.png')}}" class="img img-responsive img-thumbnail comment-img">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>
                                                                    @if($ad_comment->admin_id)
                                                                        Admin
                                                                    @else
                                                                        {{ $comment->name }}
                                                                    @endif
                                                                </strong>
                                                                <p>{{ $ad_comment->content }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

@endsection
