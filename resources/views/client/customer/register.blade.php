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
                    <li>Đăng ký</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!-- customer login start -->
@include('errors.check_error')
<div class="customer_login">
<div class="row">
            <!--register area start-->
            <div class="col-md-3"></div>
            <div class="col-lg-6 col-md-6">
                <div class="account_form register">
                    <h2>Đăng ký tài khoản</h2>
                    <form action="{{ route('postSignUp')}}" method="POST">
                        @csrf
                        <p>
                            <label>Mã xác thực<span>*</span></label>
                            <input type="text" required="" name="customer_verification_code_register" value=" ">
                        @error('customer_verification_code_register')
                        <p class="alert alert-danger"> {{ $message }}</p>
                        @enderror
                        </p>
                        <p>
                            <label>Tên<span>*</span></label>
                            <input type="text" name="name" value="{{old('name')}}"/>
                            @error('name')
                            <p class="alert alert-danger"> {{ $message }}</p>
                            @enderror
                        </p>

                        <p>
                            <label>Email<span>*</span></label>
                            <input type="text"  name="email" value="{{old('email')}}">
                            @error('email')
                            <p class="alert alert-danger"> {{ $message }}</p>
                            @enderror
                         </p>

                        <p>
                            <label>Địa chỉ<span>*</span></label>
                            <input type="text"  name="address" value="{{old('address')}}">
                        @error('address')
                        <p class="alert alert-danger"> {{ $message }}</p>
                        @enderror
                        </p>

                        <p>
                            <label>Số điện thoại<span>*</span></label>
                            <input type="text"  name="phone_number" value="{{old('phone_number')}}">
                        @error('phone_number')
                        <p class="alert alert-danger"> {{ $message }}</p>
                        @enderror
                        </p>

                         <p>
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password"  name="password" value="{{old('password')}}">
                            @error('password')
                            <p class="alert alert-danger"> {{ $message }}</p>
                            @enderror
                         </p>

                         <p>
                            <label>Xác nhận mật khẩu <span>*</span></label>
                            <input type="password" name="confirm_password">
                            @error('confirm_password')
                            <p class="alert alert-danger"> {{ $message }}</p>
                            @enderror
                         </p>

                        <div class="login_submit">
                            <button type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
</div>
<!-- customer login end -->
@endsection
