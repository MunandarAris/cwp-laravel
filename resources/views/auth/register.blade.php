<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UAS Praktik Pemrograman Backend | - Daftar</title>
    <link rel="icon" href="{{URL('./dist/img/logo-white.png')}}" type="image/x-icon" media="(prefers-color-scheme:no-preference)" />
    <link rel=" icon" href="{{URL('./dist/img/logo-black.png')}}" type="image/x-icon" media="(prefers-color-scheme:dark)" />
    <link rel="icon" href="{{URL('./dist/img/logo-white.png')}}" type="image/x-icon" media="(prefers-color-scheme:light)" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('./plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('./dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <script src="{{asset('./dist/js/pages/icon.js')}}"></script>
    
    
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <img src="./dist/img/logo-black.png" alt="Logo" height="70" width="70">
                        </td>
                        <td class="align-middle">
                            <h4>Bella Ananda Putri</h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <form action="/register24" method="post" class="form-signin w-100 m-auto">
                    <p class="login-box-msg">Daftar untuk membuat akun baru</p>
                    @csrf
                    <div class="form-floating my-3 text-secondary">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <label for="name"><span class="fas fa-user">&nbsp;</span>Nama Lengkap</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating my-3 text-secondary">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <label for="email"><span class="fas fa-envelope">&nbsp;</span>Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating my-3 text-secondary">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><span class="fas fa-lock">&nbsp;</span>Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-block btn-primary">
                        Daftar
                        </button>
                    </div>
                    Sudah punya akun? <a href="/login24" class="text-center">Login</a>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{asset('./plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script type="text/javascript" src="{{asset('./plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{asset('./dist/js/adminlte.min.js')}}"></script>
</body>
</html>
