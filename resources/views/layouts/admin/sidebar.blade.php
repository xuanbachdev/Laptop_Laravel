<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">LAPTOP</li>
                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="remixicon-dashboard-line"></i>
                        <span> Thống kê </span>
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->role_id == 1)
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý nhân viên </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{route('staffs.index')}}">Danh sách nhân viên</a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="javascript: void(0);" aria-expanded="false">Thêm nhân viên--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">Danh sách vai trò</a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{route('categories.view')}}" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý danh mục </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('suppliers.view')}}" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý nhà cung cấp </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản Lý Sản Phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{route('products.view')}}">Danh sách sản phẩm</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">Thông tin CPU-GPU
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="{{route('cpus.view')}}">CPU</a>
                                </li>
                                <li>
                                    <a href="{{route('gpus.view')}}">GPU</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="{{route('comments.index')}}">Quản lý bình luận</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('coupons.view')}}" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý mã khuyến mại </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-layout-line"></i>
                        {{-- <span class="badge badge-pink float-right">New</span> --}}
                        <span>Quản Lý Đơn Hàng</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{route('orders.index')}}">Đơn Hàng</a>
                        </li>
                        {{-- <li>
                            <a href="{{URL::to('/order-add')}}">Đơn Hàng Đang Tạo</a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{URL::to('/transport-fee')}}">Phí Vận Chuyển</a>
                        </li> --}}
                    </ul>
                </li>


                {{--
                         <li>
                             <a href="javascript: void(0);" class="waves-effect">
                                 <i class="remixicon-layout-line"></i>
                                 <span class="badge badge-pink float-right">New</span>
                                 <span>Quản Lý Giao Hàng</span>
                                 <span class="menu-arrow"></span>
                             </a>
                             <ul class="nav-second-level" aria-expanded="false">
                                 <li>
                                     <a href="{{URL::to('/update-order-id-delivery')}}">Giao Hàng</a>
                                 </li>
                                 <li>
                                     <a href="{{URL::to('/transport-fee')}}">Phí Vận chuyển</a>
                                 </li>
                                 <li>
                                     <a href="{{URL::to('/customer')}}">Khách Hàng</a>
                                 </li>
                             </ul>
                         </li> --}}


                <li>
                    <a href="{{route('blogs.view')}}" class="waves-effect">
                        <i class="remixicon-folder-add-line"></i>
                        <span>Quản lý bài viết</span>
                        <span class="menu-arrow"></span>
                    </a>
                    {{--                            <ul class="nav-second-level nav" aria-expanded="false">--}}
                    {{--                                <li>--}}
                    {{--                                    <a href="{{URL::to('/about-store')}}">Cửa Hàng</a>--}}
                    {{--                                </li>--}}
                    {{--                                --}}{{-- <li>--}}
                    {{--                                    <a href="{{URL::to('/product-news')}}">Tin Tức</a>--}}
                    {{--                                </li> --}}

                    {{--                                <li>--}}
                    {{--                                    <a href="javascript: void(0);" aria-expanded="false">Hiển Thị Website--}}
                    {{--                                        <span class="menu-arrow"></span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <ul class="nav-third-level nav" aria-expanded="false">--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{URL::to('/slideshow')}}">Slideshow</a>--}}
                    {{--                                        </li>--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{URL::to('/headershow')}}">Header</a>--}}
                    {{--                                        </li>--}}

                    {{--                                    </ul>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                </li>
                <li>
                    <a href="{{route('users.index')}}" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản Lý người dùng</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
{{--                        <li>--}}
{{--                            <a href="{{route('customers.index')}}">Khách Hàng</a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{route('users.index')}}">Người dùng</a>--}}
{{--                        </li>--}}

                    </ul>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý của hàng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{route('sliders.view')}}">Quản lý slider-banner</a>
                        </li>

                        <li>
                            <a href="{{route('settings.index')}}">Cấu hình hệ thống</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
