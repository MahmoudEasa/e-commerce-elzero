<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Unknown Title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{URL::asset('css/styles.css')}}" rel="stylesheet" />
    {{-- @vite('resources/sass/app.scss') --}}
</head>
<body id="page-top">
    {{-- Start Navigation Bar --}}
        {{-- @include('layout.navbar') --}}
    {{-- End Navigation Bar --}}

    {{-- Start Contant --}}
    <div class="page-section">
        {{-- Start Sidebar --}}
        {{-- @include('layout.sidebar') --}}
        {{-- End Sidebar --}}

        @yield('contant')
    </div>
    {{-- End Contant --}}

    {{-- Start Footer --}}
        {{-- @include('layout.footer') --}}
    {{-- End Footer --}}

    {{-- Start Portfolio Models --}}
        {{-- @include('layout.portfolioModals') --}}
    {{-- End Portfolio Models --}}


    <!-- Bootstrap core JS-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- Core theme JS-->
    {{-- <script src="{{URL::asset('js/scripts.js')}}"></script> --}}
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    {{-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> --}}
</body>
</html>
