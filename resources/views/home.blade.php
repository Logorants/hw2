@extends('layout.app')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/home_script.js') }}" defer></script>
@endsection

@section('title_main')
    mission
@endsection

@section('desc_main')
    La nostra mission è offrire un luogo ai fornitori per poter monitorare il comportamento dei consumatori sulle
    varie piattaforme di e-commerce nostre partner, in maniera da permettere loro di adoperare le adeguate
    strategie di mercato
@endsection

@section('content')
    <div id="details">
        <div>
            <img src="{{ asset('images/homepage_info/Money.png') }}" alt="Earn">
            <h1>Earn</h1>
            <p>Guadagna di più grazie ai nostri servizi: trova la piattaforma di e-commerce che più soddisfa le tue
                esigenze</p>
        </div>
        <div>
            <img src="{{ asset('images/homepage_info/Graph.png') }}" alt="Stats">
            <h1>Stats</h1>
            <p>Controlla le statistiche in tempo reale sulle tendenze dei consumatori in un dato periodo</p>
        </div>
        <div>
            <img src="{{ asset('images/homepage_info/Handlens.png') }}" alt="Inspect">
            <h1>Inspect</h1>
            <p>Ogni prodotto che vendi oltre ai numeri ha pure una storia, lascia che sia Conbox a tenerne traccia!</p>
        </div>
        <div>
            <img src="{{ asset('images/homepage_info/Data.png') }}" alt="Data">
            <h1>Data</h1>
            <p>I dati da noi raccolti rispettano la privacy degli utenti dei nostri partner, non condivideremo mai i
                dati sensibili dei consumatori</p>
        </div>
    </div>

    <div id="news">
        <h1>articoli</h1>
        <div class="articles_shelf"></div>
    </div>
@endsection
