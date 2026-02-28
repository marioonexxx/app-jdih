<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') - JDIH Kabupaten Maluku Barat Daya</title>

    <meta name="description"
        content="Portal Resmi Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kabupaten Maluku Barat Daya. Menyediakan dokumentasi produk hukum daerah seperti Perda, Perbup, dan peraturan lainnya.">
    <meta name="keywords"
        content="JDIH, Produk Hukum, Peraturan Daerah, Perda, Perbup, Maluku Barat Daya, MBD, Hukum, Tiakur">
    <meta name="author" content="Bagian Hukum Setda Kabupaten Maluku Barat Daya">

    <link href="{{ asset('assets/img/logo-mbd.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('story/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('story/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('story/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('story/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('story/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('story/assets/css/main.css') }}" rel="stylesheet">

    <style>
        :root {
            /* Menyesuaikan warna tema dengan warna biru resmi pemerintah/hukum jika perlu */
            --nav-hover-color: #0061f2;
        }

        .page-title .breadcrumbs ol li+li::before {
            color: #6c757d;
            content: "/";
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center position-relative">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0 text-decoration-none">
                <img src="{{ asset('img/Lambang_Kabupaten_Maluku_Barat_Daya.png') }}" alt="Logo Pemkab MBD"
                    class="me-1">

                <img src="{{ asset('img/logo-awal-jdihn-small.png') }}" alt="Logo JDIHN" class="me-2">

                <h1 class="sitename">JDIH MBD</h1>
            </a>

            @include('layouts.partial.sidebar-guest')

            {{-- <div class="header-social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> --}}

        </div>
    </header>

    @yield('content')

    @include('layouts.partial.footer-guest')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('story/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('story/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('story/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('story/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('story/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('story/assets/js/main.js') }}"></script>

</body>

</html>
