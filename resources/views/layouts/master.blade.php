<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LAPTOP STORE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <meta name="csrf-token" content="{{csrf_token()}}">--}}
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('clients/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('clients/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('clients/ionicons-2.0.1/css/ionicons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('clients/css/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/bundle.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/lightslider.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/prettify.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/rate.css')}}">
    <link href="{{asset('theme_admin/css/gearvn.css')}}" rel="stylesheet">
    <script src="{{asset('clients/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <link href="{{asset('clients/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/carousel.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/carousel-product.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('clients/css/custom.css')}}" >
    <link rel="stylesheet" href="{{asset('clients/css/jquery.rateyo.min.css')}}">
{{--    Alert--}}
<!-- CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/alertify.min.css')}}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{asset('clients/css/alertifyjs/css/themes/default.min.css')}}"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{asset('clients/css/alertifyjs/css/themes/semantic.min.css')}}"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{asset('clients/css/alertifyjs/css/themes/bootstrap.min.css')}}"/>

    @yield('css')
</head>
<body>
<!-- Add your site or application content here -->

<!--pos page start-->
<div class="pos_page">
    <div class="container">
        <!--pos page inner-->
        <div class="pos_page_inner">
            <!--header area -->
            <div class="header_area">
                <!--header top-->

{{--            @include('layouts.clients.cart')--}}
            @include('layouts.clients.header')

            <!--header middel end-->
            <!-- menu -->
            @include('layouts.clients.menu')

                <!-- end menu -->
            </div>
            <!--header end -->
            <!-- content -->
            <!--pos home section-->

        @yield('content')

        <!--pos home section end-->
            <!-- end content -->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->

<!--footer area start-->
@include('layouts.clients.footer')
<!--footer area end-->
<!-- all js here -->

<script src="{{ asset('clients/js/jquery-latest.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript" src="{{ asset('clients/js/jquery.touchSwipe.min.js') }}"></script>
<script src="{{asset('clients/js/sweetalert.min.js')}}"></script>
<script src="{{asset('clients/js/popper.js')}}"></script>
<script src="{{asset('clients/js/bootstrap.js')}}"></script>
<script src="{{asset('clients/js/bootstrap.min.js')}}"></script>
<script src="{{asset('clients/js/ajax-mail.js')}}"></script>
<script src="{{asset('clients/js/plugins.js')}}"></script>
<script src="{{asset('clients/js/main.js')}}"></script>
<script src="{{asset('clients/js/style.js')}}"></script>
<script src="{{asset('clients/js/core.js')}}"></script>
<script src="{{asset('clients/js/store.js')}}"></script>
<script type="text/javascript" src="{{ asset('clients/js/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{asset('clients/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('clients/js/prettify.js')}}"></script>
<script src="{{asset('clients/js/lightslider.js')}}"></script>
<script src="{{asset('clients/js/carousel.js')}}"></script>
{{--@parent--}}
<script src="{{ asset('clients/js/carousel-product.js') }}"></script>
<!-- JavaScript -->
<script src="{{asset('clients/js/alertify.min.js')}}"></script>
@yield('js')
<script>
    $('.alert')
        .fadeTo(3000, 300)
        .slideUp(300, function () {
            $('.alert').slideUp(300);
        });
</script>
<script>
    //xử lí tìm kiếm sản phẩm
    $(document).ready(()=>{
        $('#txtSearch').keypress(function(event){
            let searchKey = this.value;
            if(searchKey.trim() != ''){
                searchUrl = `{{route('products.livesearch')}}?q=${searchKey}`;
                if(event.key=='Enter'){
                    console.log(searchKey);
                    location.href=`{{route('searchProduct')}}?q=${searchKey}`;
                }
                //xử lí live search
                $.ajax({
                    url: searchUrl,
                    method: 'get',
                    success: function(result){
                        console.log(result)
                    },
                    error: function(response){
                        console.log('error!',response)
                        // hiển thị tên và link sản phẩm chỗ khung tìm kiếm
                    }
                })
            }

        })
    })
</script>
<script>
    $(document).ready(function() {
        if(document.getElementById('count_rate')){
            var count_rate =document.getElementById('count_rate').value;//=100%
        }else{
            var count_rate =1;
        }
        if(document.getElementById('rating-1-star')){
            var rating_star_1=((document.getElementById('rating-1-star').value)*100)/count_rate;
        }else{
            var rating_star_1=0;
        }
        if(document.getElementById('rating-2-star')){
            var rating_star_2=((document.getElementById('rating-2-star').value)*100)/count_rate;
        }else{
            var rating_star_2=0;
        }
        if(document.getElementById('rating-3-star')){
            var rating_star_3=((document.getElementById('rating-3-star').value)*100)/count_rate;
        }else{
            var rating_star_3=0;
        }
        if(document.getElementById('rating-4-star')){
            var rating_star_4=((document.getElementById('rating-4-star').value)*100)/count_rate;
        }else{
            var rating_star_4=0;
        }
        if(document.getElementById('rating-5-star')){
            var rating_star_5=((document.getElementById('rating-5-star').value)*100)/count_rate;
        }else{
            var rating_star_5=0;
        }

        $('.bar span').hide();
        $('#bar-five').animate({
            width: rating_star_5+'%'}, 1000);
        $('#bar-four').animate({
            width: rating_star_4+'%'}, 1000);
        $('#bar-three').animate({
            width: rating_star_3+'%'}, 1000);
        $('#bar-two').animate({
            width: rating_star_2+'%'}, 1000);
        $('#bar-one').animate({
            width: rating_star_1+'%'}, 1000);
        setTimeout(function() {
            $('.bar span').fadeIn('slow');
        }, 1000);
    });
</script>
<script>
    $(function () {
        if(document.getElementById('average_rating')!=null){
            var average_rating = document.getElementById('average_rating').value;
        }else{
            var average_rating =0;
        }
        $("#ratetotal").rateYo({
            rating    : average_rating ,
            spacing   : "5px",
            readOnly: true,
            multiColor: {
                "endColor"  : "#f7bf17"
            }
        });
    });
    $(function () {
        if(document.getElementById('average_rating')!=null){
            var average_rating = document.getElementById('average_rating').value;
        }else{
            var average_rating =0;
        }
        $("#ratetotal1").rateYo({

            rating    : average_rating ,
            spacing   : "5px",
            readOnly: true,
            multiColor: {
                "endColor"  : "#f7bf17"
            }
        });
    });
    $(function () {
        if(document.getElementById('average_rating')!=null){
            var average_rating = document.getElementById('average_rating').value;
        }else{
            var average_rating =0;
        }
        $("#rateYo").rateYo({
            rating    : average_rating ,
            spacing   : "5px",
            readOnly: true,
            multiColor: {
                "endColor"  : "#f7bf17"
            }
        });
    });
</script>
<script type="text/javascript">
    var ratedIndex=-1;
    function resetColors(){
        $(".rps i").css('color','#e2e2e2')
    }
    function setStars(max){
        for(var i=0;i<=max;i++){
            $(".rps i:eq(" + i +")").css('color','#f7bf17')
        }
    }
    $(document).ready( function () {
        resetColors();
        localStorage.removeItem("rating");
        $('.rps i').mouseover(function(){
            resetColors();
            var currentIndex = parseInt($(this).data("index"));
            setStars(currentIndex);
        })
        $('.rps i').on('click',function(){
            ratedIndex = parseInt($(this).data("index"));
            localStorage.setItem("rating",ratedIndex);
            $(".starRateV").val(parseInt(localStorage.getItem("rating")));
        })
        $('.rps i').mouseleave(function(){
            resetColors();
            if(ratedIndex != -1){
                setStars(ratedIndex);
            }
        })
        if(localStorage.getItem("rating")!=null){
            setStars(parseInt(localStorage.getItem("rating")));
            $("starRateV").val(parseInt(localStorage.getItem("rating")));
        }


    } );
</script>
</body>
</html>


