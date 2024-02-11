@extends('layouts.guest')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('images/general/app-logo.png') }}" height="36" alt="">
                </a>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Daftar Akun Baru</h2>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="{{ old('password') }}" placeholder="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="mb-3">
            <label class="form-check">
              <input type="checkbox" class="form-check-input">
              <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and
                  policy</a>.</span>
            </label>
          </div> --}}
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Sudah punya akun? <a href="{{ url('login') }}" tabindex="-1">Login disini</a>
            </div>
        </div>
    </div>
@endsection
