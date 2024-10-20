<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $page_title }} - {{ $companyInfo->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <!-- Favicon  -->
    <link href="{{ asset('assets/images/favicon/' . $companyInfo->favicon) }}" rel="shortcut icon" />
    <!-- Scripts -->
    @include('frontend.layouts.script-header')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-black">
    <div class="flex flex-col">
        @include('frontend.layouts.navigation')

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- Page Content -->
    </div>

    @include('frontend.layouts.include.footer')
</body>

</html>
