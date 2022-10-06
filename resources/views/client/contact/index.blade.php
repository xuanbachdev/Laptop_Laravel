@extends('layouts.master')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Cửa Hàng</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--about section area -->
        <div class="about_section section_two">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="about_content">
                        <h1>Laptop Store</h1>
{{--                        <p> </p>--}}
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Đống Đa, Hà Nội}</p>
                        <p><i class="fa fa-mobile" aria-hidden="true"></i> (84+) 092969xxxx</p>
                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> contact@gmail.com </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="about_thumb">
{{--                        <img src="" width="710px" height="340px"  alt="">--}}
                    </div>
                </div>
            </div>
        </div>
    <!--about section end-->
@endsection
