@extends('layouts.error')

@section('title')
    <title>403</title>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container text-center">
        <div class="welcome">
            <div class="title">
                <h1>DỪNG LẠI ...!</h1>
            </div>
            <p class="desc_1">Bạn không có quyền truy cập vào trang này ^^</p>
            <p class="desc_2"> Vui lòng liên hệ admin và quay lại sau </p>
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
