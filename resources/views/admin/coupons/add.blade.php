@extends('layouts.admin')

@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        @include('errors.check_error')
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{route('coupons.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Thêm coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin mã giảm giá</h4>
                            <hr>
                            <form action="{{route('coupons.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên mã giảm giá</label>
                                            <input type="text" name="name" id="" placeholder="Nhập tên mã giảm giá" class="form-control" value="{{ old('name') }}">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Mã giảm giá</label>
                                            <input type="text"
                                                   name = "code"
                                                   class="form-control" placeholder="Nhập mã giảm giá" value="{{old('code')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" min="0"
                                                   name = "coupon_quantity"
                                                   class="form-control" placeholder="Nhập số lượng giảm giá" value="{{old('code')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Giảm giá theo</label>
                                            <div>
                                                @foreach ($typeList as $index => $type)
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="type" value="{{ $index }}" {{ old('type') == $index? 'checked':'' }}>
                                                            {{ $type }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số % giảm: </label>
                                            <input class="form-control" type="number" name="discount_percent" id="" min="0" max="100"
                                                   step="0.1" value="{{ old('discount_percent') }}">
                                            @error('discount_percent')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số tiền giảm: </label>
                                            <input class="form-control" type="number" name="discount_amount" id="" min="0"
                                                   value="{{ old('discount_amount') }}">
                                            @error('discount_amount')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày bắt đầu: </label>
                                            <input class="form-control" type="date" name="start_day" id=""
                                                   value="{{ old('start_day') }}">
                                            @error('start_day')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày hết hạn: </label>
                                            <input class="form-control" type="date" name="expired_at" id=""
                                                   value="{{ old('expired_at') }}">
                                            @error('expired_at')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-primary">Thêm mã giảm giá</button>

                            </form>

                            <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-box -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <!-- end content -->
            <!-- end page title -->
        </div>
        <!-- container -->
    </div>
@endsection

