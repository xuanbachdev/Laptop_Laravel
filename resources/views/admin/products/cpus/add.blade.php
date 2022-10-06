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
                                    <a href="{{route('cpus.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Thêm thông tin CPU</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin CPU</h4>
                            <hr>
                            <form  id="add_cpu">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tên mã CPU: </label>
                                            <input type="text" name="name" id="name" placeholder="Ví dụ: Intel Core i5 5200U..." class="form-control" value="{{old('name')}}">
                                            @error('name')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hãng SX</label>
                                            <select name="brand" id="brand" class="form-control">
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand}}" @if( old('brand')==$brand) selected @endif>{{$brand}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Series CPU: </label>
                                            <select name="series" id="series" class="form-control">
                                                @foreach($series as $serie)
                                                    <option value="{{$serie}}" @if( old('series')==$serie) selected @endif>{{$serie}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Thế hệ: </label>
                                            <input type="text" name="gen" id="gen" placeholder="Ví dụ: 5 - Tên thế hệ..." class="form-control" value="{{old('gen')}}">
                                            @error('gen')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Số lõi: </label>
                                            <input type="number" name="cores" min="1" placeholder="Ví dụ: 1" id="cores" class="form-control" value="{{old('cores')}}">
                                            @error('cores')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Số Luồng: </label>
                                            <input type="number" name="threads" min="1" placeholder="Ví dụ: 1" id="threads" class="form-control" value="{{old('threads')}}">
                                            @error('threads')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Mức xung cơ bản: </label>
                                            <input type="text" name="base_clock" placeholder="Ví dụ: 2.1Ghz..." id="base_clock" class="form-control" value="{{old('base_clock')}}">
                                            @error('base_clock')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mức xung turbo: </label>
                                            <input type="text" name="turbo_clock" placeholder="Ví dụ: 4.0 Ghz..." id="turbo_clock" class="form-control" value="{{old('turbo_clock')}}">
                                            @error('turbo_clock')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bộ nhớ cache: </label>
                                            <input type="text" name="cache" placeholder="Ví dụ: 8MB cache L3" id="cache" class="form-control" value="{{old('cache')}}">
                                            @error('cache')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Đồ họa tích hợp: </label>
                                            <input type="text" name="integrated_gpu" placeholder="Ví dụ: UHD 620 Graphic..." id="integrated_gpu" class="form-control" value="{{old('intergrated_gpu')}}">
                                            @error('integrated_gpu')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ngày ra mắt: </label>
                                            <input type="date" name="release_date" id="release_date" class="form-control" value="{{old('release_date')}}">
                                            @error('release_date')
                                            <p class="alert text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button text-center">
                                    <button type="submit" class="btn btn-primary btn_cpu" data-href ="{{route('cpus.view')}}" data-url="{{route('cpus.store')}}">Lưu</button>
                                </div>
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
@section('js')
    <script type="text/javascript" src="{{ asset('admins/cpu/main.js') }}"></script>
@endsection
