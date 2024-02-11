@extends('layouts.reset-password')

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

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $request->email) }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password Baru')" />
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                            name="password_confirmation" value="{{ old('password_confirmation') }}">
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Buat Password baru</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
