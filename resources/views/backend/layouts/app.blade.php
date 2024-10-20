<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $page_title }} - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">
    <!-- Admin Template -->
    <link rel="stylesheet" href="{{ asset('assets/template/backend/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Favicon  -->
    <link href="{{ asset('assets/images/favicon/' . $companyInfo->favicon) }}" rel="shortcut icon" />
    <script src="//unpkg.com/alpinejs" defer></script>

    @yield('script_addon_header')
</head>

<body class="sidebar-mini control-sidebar-slide-open">
    <div class="wrapper">
        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('storage/images/generals/' . $companyInfo->logo) }}" alt="AdminLTELogo" height="150"
                width="150">
        </div> --}}

        @include('backend.layouts.navigation')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $page_title }}</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backend.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $page_title }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>

        @include('backend.layouts.footer')
    </div>

    @include('backend.layouts.script')
    @yield('script_addon_footer')
</body>

</html>
