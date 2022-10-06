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
                                    <a href="{{route('gpus.view')}}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay lại</a>
                                </div>
                            </div>
                            <ol class="breadcrumb page-title">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ strtoupper(config('app.name')) }}</a></li>
                                <li class="breadcrumb-item active">Sửa thông tin GPU</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông tin GPU</h4>
                            <hr>
                            <form action="" id="edit_gpu">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Tên mẫu GPU: </label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{$gpu->name}}" placeholder="Ví dụ: GTX 1650TI...">
                                        <input type="hidden" name="id" id="id" class="form-control" value="{{$gpu->id}}" placeholder="Ví dụ: GTX 1650TI...">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Thương hiệu: </label>
                                        <select name="brand" id="brand" class="form-control">
                                            @foreach($brandList as $brand)
                                                <option value="{{$brand}}" {{$gpu->brand==$brand?"selected":""}}>{{$brand}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Series</label>
                                        <select name="series" id="series" class="form-control">
                                            @foreach($seriesList as $series)
                                                <option value="{{$series}}" {{$gpu->series==$series?"selected":""}}>{{$series}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Ngày ra mắt: </label>
                                        <input type="date" name="release_date" id="release_date" class="form-control" value="{{substr($gpu->release_date,0,10)}}">
                                        @error('release_date')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Dung lượng V-Ram: </label>
                                        <input type="text" name="graph_memory_cap" id="graph_memory_cap" class="form-control" value="{{$gpu->graph_memory_cap}}" placeholder="Ví dụ: 4GB...">
                                        @error('graph_memory_cap')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Xung nhịp GPU: </label>
                                        <input type="text" name="clock" id="clock" class="form-control" value="{{$gpu->clock}}" placeholder="Ví dụ: 4000Mhz...">
                                        @error('clock')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Thông tin thêm: </label>
                                        <textarea name="addition" id="addition" class="form-control" placeholder="Mô tả thêm...">{{$gpu->addition}}</textarea>
                                    </div>
                                    @error('addition')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-button text-center">
                                    <button type="submit" data-href="{{route('gpus.view')}}" data-url="{{route('gpus.update', ['id' => $gpu->id])}}" class="btn btn-primary edit_gpu">Update</button>
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
    <script src="{{asset('admins/gpu/main.js')}}"></script>
@stop
