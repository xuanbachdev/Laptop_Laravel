@extends('layouts.master')

@section('css')
    <link href="{{ asset('frontend/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }} " rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }} " rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }} " rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-3 mt-5">
        <div class="left-sidebar">
            <h2>Danh mục sản phẩm</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                @foreach($categorys as $category)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{ $category->id }}">
                                <span class="pull-right">
                                     @if($category->childCategory->count())
                                        <i class="fa fa-plus"></i>
                                    @endif
                                </span>
                                    {{ $category->name }}
                                </a>
                            </h4>
                        </div>

                        <div id="sportswear_{{ $category->id }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @foreach($category->childCategory as $categoryChild)
                                        <li><a href="{{ route('product.category',
                                        ['slug' => $categoryChild->slug, 'id'=>$categoryChild->id])}}">{{ $categoryChild->name }} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div><!--/category-products-->


        </div>
    </div>

    <section>
        <div class="container">
            <div class="row">
                <h2 class="pull-right text-center mt-5">Danh mục {{$nameCategory}}</h2>
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center"></h2>
                        @foreach($product as $products)
                            <div class="col-sm-6">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img width="200px"  height="200px" src="{{ config('app.base_url') .$products->feature_image_path }}" alt=""/>
                                            <h2>{{ number_format($products->price) }} VND</h2>
                                            <p>{{ $products->name }}</p>
                                            <a href="#"
                                               data-url="{{route('addToCart',$products->id)}}" class="btn btn-default add_to_cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $product->links() }}

                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
