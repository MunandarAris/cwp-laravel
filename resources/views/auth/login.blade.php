<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UAS Praktik Pemrograman Backend | - Login</title>
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
    @if (Session::has('success_message'))
        <div class="modal fade" id="success-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fas fa-check text-info"></i>&nbsp;
                            {{ session('success_message') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
    @if (Session::has('error_message'))
        <div class="modal fade" id="error-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fas fa-exclamation text-danger"></i>&nbsp;
                            {{ session('error_message') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
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
                <form action="/login24" method="post" class="form-signin w-100 m-auto">
                    @csrf
                    <div class="form-floating my-3 text-secondary">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        <label for="email"><span class="fas fa-envelope">&nbsp;</span>Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating my-3 text-secondary">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                        <label for="password"><span class="fas fa-lock">&nbsp;</span>Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-block btn-primary">
                        Login
                        </button>
                    </div>
                    Belum punya akun? <a href="/register24" class="text-center">Daftar</a>
                    <a class="btn-link float-right" data-toggle="modal" data-target="#modal-admin">
                        Login Admin
                    </a>
                    <div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Login Admin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <table style="border:0;">
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><b>:</b></td>
                                                <td>bella@backend.id</td>
                                            </tr>
                                            <tr>
                                                <td><b>Password</b></td>
                                                <td><b>:</b></td>
                                                <td>utsbackend</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                            </div>
                        </div>
                    </div>
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
    @if (Session::has('error_message'))
        <script>
            $(document).ready(function(){
                $("#error-message").modal();
            }); 
        </script>
    @endif
    @if (Session::has('success_message'))
        <script>
            $(document).ready(function(){
                $("#success-message").modal();
            }); 
        </script>
    @endif
</body>
</html>
