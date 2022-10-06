<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                {{-- @if(Session::get('admin_image'))
                <img src="{{asset('/uploads/admin/staff/'.Session::get('admin_image'))}}" alt="user-image" class="rounded-circle">
                @else
                <img src="{{asset('/backend/images/users/businessman.jpg')}}" alt="user-image" class="rounded-circle">
                @endif --}}
                <span class="pro-user-name ml-1">
                   {{ Auth::guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Xin chào !</h6>
                </div>
                <!-- item-->
                <a href="#" class="dropdown-item notify-item">
                    <i class="remixicon-account-circle-line"></i>
                    <span>Tài khoản</span>
                </a>
                <!-- item-->
                <a href="#" class="dropdown-item notify-item">
                    <i class="remixicon-lock-line"></i>
                    <span>Đổi mật khẩu</span>
                </a>
                <a href="#" class="dropdown-item notify-item">
                    <i class="remixicon-lock-line"></i>
                    <span>Đổi email</span>
                </a>
                <div class="dropdown-divider"></div>
                <!-- item-->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                </a>
            </div>
        </li>
    </ul>
    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ URL::to('/dashboard') }}" class="logo text-center">
            <span class="logo-lg">
                    {{-- <img src="{{asset('/backend/images/logo-light.png')}}" alt="" height="20"> --}}
                    <h3><i class='fab fa-staylinked'></i> Laptop ADMIN</h3>
                    {{-- <span class="logo-lg-text-light">XBIT</span> --}}
            </span>
            <span class="logo-sm">
                    <!-- <span class="logo-sm-text-dark">X</span> -->
            {{-- <img src="{{asset('/backend/images/logo-sm.png')}}" alt="" height="24"> --}}
            <h4><i class='fab fa-staylinked'></i></h4>
            </span>
        </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
        </li>
    </ul>
</div>

@include('layouts.admin.logout_modal')
