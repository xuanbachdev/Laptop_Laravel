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
                        <li>Đăng nhập</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!-- customer login start -->
    <div class="customer_login">
        <div class="row">
            <!--login area start-->

            <div class="col-md-3"></div>
            <div class="col-lg-6 col-md-6">
                <div class="account_form">
                    <h2 style="text-align: center">Đăng nhập</h2>
                    @include('errors.check_error')
                    <form action="{{route('customer.postLogin')}}" method="POST">
                        @csrf
                        <p>
                            <label>Email <span>*</span></label>
                            <input name="customer_email_login" value="{{old('customer_email_login')}}">
                        @error('customer_email_login')
{{--                        <div class="alert alert-danger text-center">--}}
                                <span class="text-danger">{{  $message }}</span>
{{--                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                        </div>--}}
                        @enderror
                        </p>
                        <p>
                            <label>Mật Khẩu <span>*</span></label>
                            <input type="password" name="customer_password_login">
                        @error('customer_password_login')
{{--                        <div class="alert alert-danger text-center">--}}
                            <span class="text-danger">{{  $message }}</span>
{{--                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--                        </div>--}}
                        @enderror
                        </p>
                        <div class="login_submit">
                            <button type="submit">Đăng nhập</button>
                            {{--  <label for="remember">
                                <input id="remember" type="checkbox">
                                Remember me
                            </label>  --}}
                            <a href="{{ URL::to('/show-verification-password-customer')}}">Quên Mật Khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->
        </div>
    </div>
    <!-- customer login end -->
@endsection
