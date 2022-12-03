<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ungnown Page')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite('resources/sass/app.scss')

</head>
<body>
    {{-- Start Navigation Bar --}}
        @include('layout.navbar')
    {{-- End Navigation Bar --}}

    {{-- Start Sidebar --}}
        @include('layout.sidebar')
    {{-- End Sidebar --}}
    <div class="container">
        @yield('body')
    </div>
</body>
</html>
