@extends('../layouts.app')

@section('title', 'Tambah Detail')

@section('sidebar-content')
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/detail24" class="nav-link active">
            <i class="nav-icon fas fa-user"></i>
            <p>Detail Data</p>
        </a>
    </li>
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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Detail Data</h3>
        </div>
        <div class="card-body">
            <form action="/detail24" method="post" id="inputForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{Auth::user()->name}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="birthplace">Tempat Lahir</label>
                            <input type="text" id="birthplace" name="birthplace" class="form-control" placeholder="Tempat Lahir" value="{{old('birthplace')}}" required>
                            @error('birthplace')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Tanggal Lahir" value="{{old('birthdate')}}" required>
                            @error('birthdate')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select id="agama" name="agama" class="form-control custom-select" required>
                                <option selected disabled>Pilih Satu</option>
                                @foreach ($agama as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                            @error('agama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control" rows="4" placeholder="Alamat" required>{{old('address')}}</textarea>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto_ktp">Foto ktp</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_ktp" name="foto_ktp" required>
                                    <label class="custom-file-label" for="foto_ktp">Pilih foto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="/detail24" class="btn btn-secondary">Batal</a>
                        <input type="submit" name="submit" value="Tambahkan" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection