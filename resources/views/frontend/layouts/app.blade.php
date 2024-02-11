<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $page_title }} - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main Layout -->
    <link rel="stylesheet" href="{{ asset('assets/template/frontend/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/template/frontend/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Masonry --}}
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</head>

<body class="bg-light">
    <main>
        @include('frontend.layouts.navigation')

        @yield('content')

        @include('frontend.layouts.footer')

        @include('frontend.layouts.script')
        @yield('script_addon')
    </main>
</body>

</html>
