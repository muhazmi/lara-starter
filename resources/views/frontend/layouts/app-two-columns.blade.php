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
    <!-- favicon  -->
    <link href="{{ asset('assets/images/favicon/' . $companyInfo->favicon) }}" rel="shortcut icon" />
    <!-- Scripts -->
    @include('frontend.layouts.script-header')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 dark:bg-black">
    @include('frontend.layouts.navigation')

    @include('frontend.layouts.include.breadcrumb')
    <!-- Main content -->
    <section id="content" class="py-3">
        <div class="max-w-screen-xl mx-auto px-7 lg:px-24">
            <div class="max-w-full mx-auto">
                <div class="flex flex-wrap">
                    <!-- Left Column - Masonry Layout -->
                    <div class="w-full lg:w-2/3 lg:pr-6">
                        @yield('content')
                    </div>

                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->

    @include('frontend.layouts.include.footer')
</body>

</html>
