<!doctype html>

<html lang="it">
<head>
    <title>Conbox - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo/ConBoxWhite.png') }}">
    <link rel="stylesheet" href="{{ asset('css/sign_inout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conbox.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @yield('scripts')
</head>

<body>

<section>
    <nav>
        <img src="{{ asset('images/logo/ConBoxWhite.png') }}" alt="conbox">
    </nav>

    <h1>@yield('welcome_message')</h1>

    @yield('form_div')
</section>

</body>

</html>
