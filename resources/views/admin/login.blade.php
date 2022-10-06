<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="56x56" href="https://www.nodemy.vn/images/fav-icon/icon.png">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('admins/css/adminlte.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins/css/login.css')}}">
</head>
<body>
<div id="page">
    <div class="logo">
        <ion-icon name="logo-react"></ion-icon>
    </div>
    <div class="container">
        <div id="signIn">
            <div class="left">
                <div class="title">
                    <h1></h1>
                </div>
            </div>
            <div class="right">
                <form action="{{route('admin.postLogin')}}" method="post">
                    @csrf
                    <h1>Admin Login</h1>
                   @include('errors.check_error')
                    <div class="info">
                        <div class="form-group">
                            <label for="#username" class="form-label">Tên đăng nhập: </label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nhập tên đăng nhập..." value="{{ old('username') }}">
                            @error('username')
                            <div class="alert alert-danger text-center">
                                {{  $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu: </label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu..." value="{{ old('password') }}">
                            @error('password')
                            <div class="alert alert-danger text-center">
                                {{  $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="actions">
                        <input type="checkbox" id="remember_me" name="remember_me">
                        <label for="remember_me">Remember Me</label>
                        <button class="signInBtn" type="submit">SignIn</button>
                    </div>

                    <!-- <div class="signInMethods">
                        <div class="signIn_facebook">
                            <img src="img/fb.png" alt="facebook_icon">
                            <p>Signin with facebook</p>
                        </div>
                        <div class="signIn_google" >
                            <img src="img/gg.png" alt="google_icon" width="32px" height="32px">
                            <p>Signin with google</p>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
{{--<!-- Bootstrap 4 -->--}}
{{--<script src="{{ asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>--}}
{{--<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>--}}
<script>
    const title = document.querySelector('.title h1')

    const letter = 'Welcome!'

    let index = 0

    setInterval(() => {
        title.textContent += letter[index]
        index++
        if (index == letter.length + 1) {
            index = 0
            title.textContent = ''
        }
    }, 500)

    $('.alert')
        .fadeTo(3000, 300)
        .slideUp(300, function () {
            $('.alert').slideUp(300);
        });
</script>
</html>
