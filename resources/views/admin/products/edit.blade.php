@extends('layouts.admin')
@section('css')
@stop
@section('content')
  <div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <div class="text-lg-right mt-3 mt-lg-0">
                                <a href="{{ route('products.view') }}" class="btn btn-success waves-effect waves-light"><i class="ti-arrow-left mr-1"></i>Quay Lại Sản Phẩm</a>
                            </div>
                        </div>
                        <ol class="breadcrumb page-title">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laptop</a></li>
                            <li class="breadcrumb-item active">Cập Nhật Sản Phẩm</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- content -->
            <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Thông Tin Sản Phẩm</h4>
                            <hr>
                                @include('errors.check_error')
                            <form action="{{route('products.update', $product->id)}}" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                @csrf
                                <h4 class="text-muted">Thông tin sản phẩm</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Tên sản phẩm</label>
                                                <input type="text" placeholder="Nhập đầy đủ tên sản phẩm..." name="name" id="txtName" class="form-control" value="{{$product->name}}">
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">SKU</label>
                                                <input type="text" placeholder="Mã SKU sản phẩm" name="sku" id="txtSku" class="form-control" value="{{$product->sku}}">
                                                @error('sku')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="">Danh mục</label>
                                                <select name="category_id" id="slCategories" class="form-control select2_init" multiple="multiple">
                                                    {!! $htmlOption !!}
                                                </select>
                                                @error('categories')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group col-md-4">
                                                <label for="InputName">Chọn nhà cung cấp:</label>
                                                <select class="form-control" id="supplier" name="supplierId">
                                                    <option value="0">---Chọn nhà cung cấp---</option>
                                                    @foreach($listSupplier as $supplier)
                                                        <option value="{{ $supplier->id }}"  {{ ($product->supplier_id==$supplier -> id)? "selected" : "" }}>{{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col form-group col-md-8">
                                                <label for="InputName">Nhập tag cho sản phẩm:</label>
                                                <select class="form-control tag_select_choose @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple" id="tags">
                                                    @foreach($product->tags as $tagsItem)
                                                        <option value="{{$tagsItem->name}}" selected>{{$tagsItem->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tags')
                                                <div class="alert alert-danger">{{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h4 class="text-muted">Bộ nhớ & ổ cứng</h4>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Bộ nhớ ram</label>
                                                <input type="text" name="memory" id="" placeholder="Ví dụ: 2 Khe ram DDR4 3200MHz..." class="form-control" value="{{$product->memory}}">
                                                @error('memory')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Dung lượng bộ nhớ ram: </label>
                                                <input type="text" placeholder="Ví dụ: 4GB | 8GB" name="memory_capacity" id="txtMemCap" class="form-control" value="{{$product->memory_capacity}}">
                                                @error('memory_capacity')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Ổ cứng SSD: </label>
                                                <input type="text" placeholder="Có hoặc bỏ trống.." name="ssd_storage" id="txtSSD" value="{{$product->ssd_storage}}" class="form-control">
                                                @error('ssd_storage')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Dung lượng ổ SSD: </label>
                                                <select name="ssd_capacity" class="form-control" id="slSSDCap">
                                                    <option value="0">0</option>
                                                    @foreach($capacity as $cap)
                                                        <option value="{{$cap}}" {{$product->ssd_capacity==$cap?"selected":""}}>{{$cap}}</option>
                                                    @endforeach
                                                </select>
                                                @error('ssd_capacity')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Ổ cứng HDD: </label>
                                                <input type="text" value="{{ $product->hdd_storage }}" placeholder="Có hoặc bỏ trống.." name="hdd_storage" id="txtHDD" class="form-control">
                                                @error('hdd_storage')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Dung lượng ổ HDD: </label>
                                                <select name="hdd_capacity" class="form-control" id="slHDDCap">
                                                    <option value="0">0</option>
                                                    @foreach($capacity as $cap)
                                                        <option value="{{$cap}}" {{$product->hdd_capacity==$cap?"selected":""}}>{{$cap}}</option>
                                                    @endforeach
                                                </select>
                                                @error('hdd_capacity')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Ảnh đại diện sản phẩm</label>
                                        <!-- Drag và Drop upload 1 ảnh -->
                                        <div class="picture-drag-drop">
                                            <div class="preview">
                                                <img src="{{$product->feature_image_path!=""? $product->feature_image_path:asset('images/default-product.png')}}" id="card-preview" alt="Xem trước ảnh bìa sản phẩm">
                                                <div class="btn-cancel-image" title="Hủy ảnh">
                                                    <i class="fa fa-times"></i>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="file" accept="image/*" dataTitle="Chọn hoặc kéo thả ảnh..." name="feature_image_path" id="singleImageInput" defaultUrl="{{asset('images/default-product.png')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- Album ảnh --}}
                                <div class="form-group">
                                    <label for="file" class="form-label">Album ảnh</label>
                                    <div class="row">
                                        @foreach($product -> productImage as $productImageDetail)
                                            <div class="col-sm-2">
                                                <div class="card">
                                                    <img width="150px" height="150px" class="card-img-top" src="{{$productImageDetail -> image_path}}" name="image_path[]" alt="Card image cap">
                                                    <div class="card-body text-center">
{{--                                                        <a href="#" class="btn btn-danger">Delete</a>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="file-loading">
                                        <input id="images" type="file" name="image_path[]" multiple class="file" data-overwrite-intial="false"
                                               data-min-file-count="0">
                                    </div>
                                </div>

                                <h4 class="text-muted">CPU & GPU</h4>
                                <div class="row">
                                    <!-- Hoàn thiện lấy cpu và gpu từ database sau -->
                                    <div class="form-group col-md-6">
                                        <label for="">CPU: </label>
                                        <select name="cpu" class="form-control" id="slCPU">
                                            @foreach($cpuList as $cpu)
                                                <option value="{{$cpu->id}}" {{$product->cpu_id==$cpu->id?'selected':''}}>{{"$cpu->brand  - $cpu->name"}}</option>
                                            @endforeach
                                        </select>
                                        @error('cpu')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <!-- Laptop có thể có 1 hoặc 2 gpu -> cần xử lý sau -->
                                    <div class="form-group col-md-6">
                                        <label for="">GPU Rời (nếu có)</label>
                                        <select name="gpu" id="slGPU" class="form-control">
                                            <option value="0">Không có</option>
                                            @foreach($gpuList as $gpu)
                                                <option value="{{$gpu->id}}" {{$product->gpu_id==$gpu->id?'selected':''}}>{{$gpu->branch}} {{$gpu->name}} - {{$gpu->graph_memory_cap}}</option>
                                            @endforeach
                                        </select>
                                        @error('gpu')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="text-muted">Màn hình</h4>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Loại màn hình</label>
                                        <select name="screen_type" id="slSCreenType" class="form-control">
                                            @foreach($screenTypes as $val)
                                                <option value="{{$val}}" {{$product->screen_type==$val?"selected":""}}>{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Kích thước màn hình</label>
                                        <select name="screen_size" id="slScreenSize" class="form-control">
                                            @foreach($screenSizes as $val)
                                                <option value="{{$val}}" {{$product->screen_size==$val?"selected":""}}>{{$val}} Inches</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Thông tin thêm về màn hình:</label>
                                    <input type="text" placeholder="Ví dụ: Antiglare, 144hz, 100% sRGB..." id="txtScreenDetail" class="form-control" name="screen_detail" value="{{$product->screen_detail}}">
                                    @error('screen_detail')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <h4 class="text-muted">
                                    Vỏ
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Chất liệu vỏ</label>
                                            <input type="text" placeholder="Ví dụ: Nhựa | Kim loại nguyên khối | ..." id="txtCaseMaterial" class="form-control" name="case_material" value="{{$product->case_material}}">
                                            @error('case_material')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Webcam</label>
                                            <input type="text" placeholder="Ví dụ: HD 720p..." id="txtCaseMaterial" class="form-control" name="webcam" value="{{$product->webcam}}">
                                            @error('webcam')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-muted">Kết nối</h4>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Bluetooth</label>
                                        <input type="text" placeholder="Ví dụ: Có, Bluetooth 5.1 ..." name="bluetooth" id="txtBluetooth" class="form-control" value="{{$product->bluetooth}}">
                                        @error('bluetooth')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Wifi</label>
                                        <input type="text" name="wifi" id="txtWifi" placeholder="Ví dụ: Wifi 6 ..." class="form-control" value="{{$product->wifi}}">
                                        @error('wifi')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Cổng kết nối</label>
                                        <input type="text" placeholder="Ví dụ: 2xUSB 3.2, 1xCombo audio/microphone jacket" name="connection_port" id="txtConnect" class="form-control" value="{{$product->connection_port}}">
                                        @error('connection_port')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="text-muted">Khác</h4>
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label for="">Bàn phím</label>
                                        <input type="text" placeholder="Ví dụ: Bàn phím full size..." name="keyboard" id="txtKeyboard" class="form-control" value="{{$product->keyboard}}">
                                        @error('keyboard')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Dung lượng pin: </label>
                                        <input type="text" placeholder="Ví dụ: 3 cells - 56Wh..." name="battery" id="txtBattery" class="form-control" value="{{$product->battery}}">
                                        @error('battery')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Màu sắc: </label>
                                        <input type="text" name="color" placeholder="Ví dụ: Bạc | Đen | Xanh | Xám..." id="txtColor" class="form-control" value="{{$product->color}}">
                                        @error('color')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Hệ điều hành theo máy: </label>
                                        <input type="text" placeholder="Ví dụ: Windows 10 Home SL | FreeOS..." name="operating_system" id="txtOperatingSystem" class="form-control" value="{{$product->operating_system}}">
                                        @error('operating_system')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Tính năng khác: </label>
                                    <textarea placeholder="Ví dụ: Bảo mật vân tay, Đèn nền bàn phím, bảo mật khuôn mặt..." type="text" name="addition" id="txtAddition" class="form-control" value="">{{$product->addition}}</textarea>
                                    @error('addition')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col form-group col-md-6">
                                    <label>Nổi bật</label>
                                    <div class="checkbox">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" value="1" type="radio" id="active" name="hot" {{ $product->hot == 1 ? 'checked' : '' }}>
                                            <label for="active" class="custom-control-label">Hiển thị</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="hot" {{ $product->hot == 0 ? 'checked' : '' }}>
                                            <label for="no_active" class="custom-control-label">Ẩn</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Kích thước máy: </label>
                                        <input type="text" name="size" id="" class="form-control" placeholder="Dài x Rộng x Dày" value="{{$product->size}}">
                                        @error('size')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Cân nặng: </label>
                                        <input type="text" name="weight" id="" class="form-control" placeholder="Ví dụ: 1.1 KG" value="{{$product->weight}}">
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Hộp sản phẩm gồm: </label>
                                        <input type="text" name="package" id="" class="form-control" placeholder="Ví dụ: Thân máy, dây nguồn..." value="{{$product->package}}">
                                        @error('package')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Bảo hành: </label>
                                        <input type="text" name="warranty_time" id="" class="form-control" placeholder="Ví dụ: 12 tháng" value="{{$product->warranty_time}}">
                                        @error('warranty_time')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputName">Mô tả sản phẩm:</label>
                                    <textarea  rows="10" class="form-control tinymce_editor_init  @error('description') is-invalid @enderror error-messages" rows="10" name="description" id="editor_init" placeholder="Mô tả sản phẩm..." value="">{{$product->description}}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <h4 class="text-muted">Thông tin kho:</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Giá bán: </label>
                                            <input type="text" name="price" id="" class="form-control" value="{{$product->price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Gỉam giá(%): </label>
                                            <input type="text" name="sale_price" id="" class="form-control" value="{{ $product->sale_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Số lượng: </label>
                                            <input type="text" name="quantity" id="" class="form-control" value="{{ $product->quantity }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tình trạng sản phẩm</label>
                                            <select name="product_status" id="" class="form-control">
                                                @foreach ($statusList as $key=> $item)
                                                    <option value="{{$key}}" {{$product->product_status==$key?'selected':''}}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="form-button btn bg-purple">Lưu</button>
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
    <!-- content -->
    <!-- Footer Start -->
    <!-- end Footer -->
</div>
@endsection

@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script src="https://cdn.tiny.cloud/1/y1miufxpg75c7j08s6ns0f0cv0dfe1go8v9993r994g3fhwa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/product/main.js')}}"></script>

    <script>
        $(document).ready(() => {
            $("#singleImageInput").on("change", (event) => {
                console.log(event.target);
                input = event.target;
                reader = new FileReader();
                reader.onload = () => {
                    $('#card-preview').attr('src', reader.result)
                    $(".btn-cancel-image").show();
                }
                reader.readAsDataURL(input.files[0])
            })
            // nút hủy ảnh
            $(".btn-cancel-image").on("click", (event) => {
                input = $("#singleImageInput")
                input.val(null)
                $('#card-preview').attr('src', input.attr('defaultUrl'))
                $(".btn-cancel-image").hide();
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
@endsection
