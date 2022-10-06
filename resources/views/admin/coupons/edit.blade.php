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
                                    <a href="{{route('coupons.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Sửa thông tin mã giảm giá</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin mã khuyến mại</h4>
                            <hr>
                            <form action="{{route('coupons.update', $coupons->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên mã giảm giá</label>
                                            <input type="text" name="name" id="" placeholder="Nhập tên mã giảm giá" class="form-control" value="{{ $coupons->name }}">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Mã giảm giá</label>
                                            <input type="text"
                                                   name = "code"
                                                   class="form-control" placeholder="Nhập mã giảm giá" value="{{ $coupons->code }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" min="0"
                                                   name = "coupon_quantity"
                                                   class="form-control" placeholder="Nhập số lượng giảm giá" value="{{ $coupons->coupon_quantity }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Giảm giá theo</label>
                                            <div>
                                                @foreach ($typeList as $index => $type)
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="type" value="{{ $index }}" {{ $coupons->type == $index? 'checked':'' }}>
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
                                                   step="0.1" value="{{ $coupons->discount_percent }}">
                                            @error('discount_percent')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số tiền giảm: </label>
                                            <input class="form-control" type="number" name="discount_amount" id="" min="0"
                                                   value="{{ $coupons->discount_amount }}">
                                            @error('discount_amount')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày bắt đầu: </label>
                                            <input class="form-control" type="date" name="start_day" id=""
                                                   value="{{ substr($coupons->start_day,0,10) }}">
                                            @error('start_day')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày hết hạn: </label>
                                            <input class="form-control" type="date" name="expired_at" id=""
                                                   value="{{ substr($coupons->expired_at,0,10) }}">
                                            @error('expired_at')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-primary ">Cập nhập mã giảm giá</button>

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

