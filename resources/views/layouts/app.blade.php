<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Photo-It') - {{ __('common.title') }}</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Local Fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body-class', 'index-page')">

    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="line"></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>