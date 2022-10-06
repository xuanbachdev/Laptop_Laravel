<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- App favicon -->
     <link rel="shortcut icon" href="{{asset('admins/images/favicon.png')}}">
    <!-- App css -->
    <link href="{{asset('admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
{{--    <link rel="stylesheet" href="{{ asset('admins/dist/css/AdminLTE.min.css')}}">--}}
    <link href="{{asset('admins/css/icons.min.css')}}"rel="stylesheet" type="text/css">
    <link href="{{asset('admins/css/app.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admins/dist/css/AdminLTE.min.css')}}">
    <link href="{{asset('admins/libs/multiselect/multi-select.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admins/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('admins/css/dataTables.bootstrap4.min.css')}}">

    <link href="{{asset('admins/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('admins/libs/custombox/custombox.min.css')}}" rel="stylesheet">
    <link href="{{asset('admins/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admins/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('admins/css/style.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body>

    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
        @include('layouts.admin.header')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.admin.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
        @include('layouts.admin.footer')
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- jQuery 3 -->
    <script src="{{asset('admins/js/vendor.min.js')}}"></script>
    <script src="{{asset('admins/js/app.min.js')}}"></script>
    <!-- jQuery 3 -->
{{--    <script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap 3.3.7 -->
{{--    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>--}}
    <script src="{{asset('admins/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{asset('admins/libs/moment/moment.min.js')}}"></script>

    <script src="{{asset('admins/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admins/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admins/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('admins/libs/dropzone/dropzone.min.js')}}"></script>

    <script src="{{asset('admins/libs/multiselect/jquery.multi-select.js')}}"></script>
    <script src="{{asset('admins/libs/select2/select2.min.js')}}"></script>

    <script src="{{asset('admins/libs/custombox/custombox.min.js')}}"></script>

    <script src="{{asset('admins/libs/footable/footable.all.min.js')}}"></script>
    {{--  <script src="{{asset('admins/js/pages/foo-tables.init.js')}}"></script>  --}}
    <script type="text/javascript" src="{{ asset('admins/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{asset('admins/js/pages/sweet-alerts.init.js')}}"></script>

    <script src="{{asset('admins/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('admins/js/sweetalert.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('admins/ckeditor/ckeditor.js')}}"></script>
    @yield('js')

<script>
    $('.alert')
        .fadeTo(2000, 300)
        .slideUp(300, function () {
            $('.alert').slideUp(300);
        });
</script>

<script>
let btn = $('#button');
$(window).scroll(function() {
  if ($(window).scrollTop() > 20) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


</script>
</body>

</html>
