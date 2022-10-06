@extends('layouts.error')

@section('title')
    <title>500</title>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container text-center">
        <div class="welcome">
            <div class="title">
                <h1>DỪNG LẠI ...!</h1>
            </div>
            <p class="desc_1">Trang bạn vừa truy cập không tồn tại</p>
            <p class="desc_2"> Có thể trang này đã bị xóa bởi admin hoặc hệ thống
                đã bị lỗi ,vui lòng quay lại sau </p>
            <button>Home Page</button>
            <div class="image">
                <img src="{{asset('images/image.png')}}" alt="">
            </div>
            <div class="redirect"></div>
            <div class="title">

            </div>
            <div class="content">
                <div class="shortcut">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
