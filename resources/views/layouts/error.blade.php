{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    @yield('title')--}}
{{--    <link rel="shortcut icon" href="img/favicon.ico">--}}
{{--    <style type="text/css">--}}
{{--        *{--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}

{{--        html{--}}
{{--            font-size: 62.5%;--}}
{{--        }--}}

{{--        h1{--}}
{{--            font-size: 3.6rem;--}}
{{--            font-weight: 700;--}}
{{--            margin: 0.67em 0;--}}
{{--        }--}}

{{--        ul{--}}
{{--            display: block;--}}
{{--            list-style-type: none;--}}
{{--            margin-block-start: 1em;--}}
{{--            margin-block-end: 1em;--}}
{{--            margin-inline-start: 0px;--}}
{{--            margin-inline-end: 0px;--}}
{{--            padding-inline-start: 40px;--}}
{{--        }--}}

{{--        li{--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        p{--}}
{{--            display: block;--}}
{{--            font-size: 2.6rem;--}}
{{--            margin-block-start: 1em;--}}
{{--            margin-block-end: 1em;--}}
{{--            margin-inline-start: 0px;--}}
{{--            margin-inline-end: 0px;--}}
{{--        }--}}

{{--        a{--}}
{{--            text-decoration: none;--}}
{{--            color: #f05123;--}}
{{--            font-size: 2.6rem;--}}
{{--        }--}}
{{--        .main{--}}
{{--            position: fixed;--}}
{{--            z-index: 99;--}}
{{--            background-color: #000;--}}
{{--            background-image: url(https://fullstack.edu.vn/static/media/sparkle.d324d8b8.jpeg);--}}
{{--            background-position: 100% 0;--}}
{{--            background-repeat: no-repeat;--}}
{{--            background-color: #010101;--}}
{{--            background-size: contain;--}}
{{--            color: #fff;--}}
{{--            font-size: 1.8rem;--}}
{{--            line-height: 1.6;--}}
{{--            font-weight: 500;--}}
{{--            text-shadow: 1px 1px 2px #000;--}}
{{--            top:  0;--}}
{{--            right: 0;--}}
{{--            bottom: 0;--}}
{{--            left: 0;--}}
{{--        }--}}

{{--        .content{--}}
{{--            padding: 60px;--}}
{{--            max-width: 580px;--}}
{{--            position: relative;--}}
{{--            z-index: 2;--}}
{{--        }--}}
{{--        .NotFound_overlay{--}}
{{--            position: absolute;--}}
{{--            min-width: 100%;--}}
{{--            min-height: 100%;--}}
{{--            background-color: rgba(0,0,0,.2);--}}
{{--            z-index: 1;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="main clearfix">--}}
{{--    <div class="content">--}}
{{--        @yield('content')--}}
{{--    </div>--}}
{{--    <div class="NotFound_overlay">--}}

{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{asset('clients/css/error.css')}}">
</head>

<body>

<div class="page-not-found">
    <div class="header">
        <div class="logo">
            <img src="{{asset('images/logo.png')}}" alt="">
        </div>
    </div>

    <div class="container">
       @yield('content')

    </div>
</div>

<script>
    let second = 10;
    let url = "/"

    function countdown(time) {
        if (time > 0) {
            setTimeout(function () {
                let redirect = document.querySelector(".redirect")
                redirect.textContent = `Về trang chủ sau ${time} giây`
                return countdown(time - 1)
            }, 1000)
        }
        else {
            redirect(url)
        }
    }
    function redirect(url) {
        window.location = url
    }

    // call countdown function
    countdown(second)
</script>
</body>

</html>
