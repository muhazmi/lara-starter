@extends('layouts.forgot-password')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1">
                    <img src="{{ asset('images/general/app-logo.png') }}" height="35" alt="">
                    <b>{{ config('app.name', 'Laravel') }}</b>
                </a>
            </div>

            <div class="card-body">
                <x-auth-session-status :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Reset Password</button>
                    </div>
                    <a href="/login" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali ke halaman Login</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
