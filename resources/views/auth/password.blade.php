@extends('../layouts.app')

@section('title', 'Ubah Password')

@section('sidebar-content')
    @if (Auth::user()->role == 'Admin')
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/agama24" class="nav-link">
                <i class="nav-icon fas fa-praying-hands"></i>
                <p>Agama</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/approval24" class="nav-link">
                <i class="nav-icon fas fa-user-check"></i>
                <p>User Approval</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/details24" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Detail User</p>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/detail24" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Detail Data</p>
            </a>
        </li>
    @endif
@endsection

@section('profile')
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if (Auth::user()->photo == null)
            <img src="{{URL('./dist/img/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
        @else
            <img src="{{URL('./uploads/profile/' . Auth::user()->photo)}}"class="user-image img-circle elevation-2" alt="User Image">
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
            @if (Auth::user()->photo == null)
                <img src="{{URL('./dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
            @else
                <img src="{{URL('./uploads/profile/' . Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
                {{strtoupper(Auth::user()->name)}}
                <small>{{Auth::user()->role}}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="/profile24" class="btn btn-dark">Profile</a>
            <a href="/logout24" class="btn btn-danger float-right">Logout</a>
        </li>
    </ul>
@endsection

@section('content-header', 'UAS Praktik Pemrograman Backend')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary d-flex flex-fill">
                <div class="card-header">
                    <h3 class="card-title">Form Ubah Password</h3>
                </div>
                <div class="card-body">
                    <form action="/password24" method="post" id="inputForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="newpass">Password Baru</label>
                                <input type="password" id="newpass" name="newpass" class="form-control" placeholder="Password Baru" value="{{old('newpass')}}" required>
                                @error('newpass')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmpass">Konfirmasi Password Baru</label>
                                <input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Konfirmasi Password Baru" value="{{old('confirmpass')}}" required>
                                @error('confirmpass')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="/profile24" class="btn btn-secondary">Batal</a>
                                <input type="submit" name="submit" value="Ubah" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection