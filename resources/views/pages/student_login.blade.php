<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CICT Library | Đăng nhập hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js">
    </script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h2>Hệ thống thư viện CICT</h2>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="login-box-msg">ĐĂNG NHẬP HỆ THỐNG</h4>

                <form action="{{ route('auth.student.login.submit') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="username">Tài khoản</label>
                        <input type="text" class="form-control" placeholder="Nhập tài khoản" name="username"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập cho sinh viên</button>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <p>- HOẶC -</p>
                    <a href="{{ route('auth.login') }}" class="btn btn-block btn-success">
                        Đăng nhập cho thủ thư
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
        };

        @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>

</body>

</html>
