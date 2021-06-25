<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="csrf_token" content="{{ csrf_token() }}">
    <title>Conbox - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo/ConBoxWhite.png') }}">
    <link rel="stylesheet" href="{{ asset('css/conbox.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="{{ asset('js/mobile_sandwich.js') }}" defer></script>
    @yield('style')
    @yield('scripts')
</head>

<body>
<header>
    <nav>
        <img src="{{ asset('images/logo/ConBoxWhite.png') }}" alt="conbox">

        @if(session('user'))
            <div id="links">
                <a href="{{ route('login') }}" class="header_link">home</a>
                <a href="{{ route('servizi') }}" class="header_link">servizi</a>
                <a href="{{ route('partner') }}" class="header_link">partner</a>
                <a href="{{ route('logout') }}" class="header_link buttonWhite1">logout</a>
            </div>
        @else
            <div id="links">
                <a href="{{ route('register') }}" class="header_link">registrati</a>
                <a href="{{ route('login') }}" class="header_link buttonWhite1">login</a>
            </div>
        @endif

        <div id="menu">
            <div></div>
            <div></div>
            <div></div>
        </div>

    </nav>

    <h1>
        <strong>conbox marketing services</strong><br/>
        <em>Massimizza le vendite col minimo sforzo</em><br/>
        @if(session('user'))
            <strong class='welcome'>Bentornato/a {{ $name." ".$surname }}</strong>
        @endif
    </h1>

</header>

<section>

    <div id="link_modal" class="hidden"></div>

    <div id="main">
        <h1>@yield('title_main')</h1>
        <p>@yield('desc_main')</p>
    </div>

    @yield('content')
</section>

<footer>
    <div>
        <strong>©2021 Luca Chisari - Tutti i diritti riservati</strong><br/>
        <em>Matricola O46002177 - UniCT</em>
    </div>
    <img src="{{ asset('images/logo/ConBoxWhite.png') }}" alt="conbox">
</footer>
</body>
</html>
