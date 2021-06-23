@extends('layout.app')

@section('title')
    Servizi
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/servizi.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/ajax_load_follows_db.js') }}" defer></script>
    <script src="{{ asset('js/ajax_check_follows_db.js') }}" defer></script>
    <script src="{{ asset('js/ajax_add_follow_db.js') }}" defer></script>
    <script src="{{ asset('js/ajax_delete_follow_db.js') }}" defer></script>
    <script src="{{ asset('js/ajax_check_prod_db.js') }}" defer></script>
    <script src="{{ asset('js/servizi_script.js') }}" defer></script>
@endsection

@section('title_main')
    area servizi
@endsection

@section('desc_main')
    In questa pagina puoi aggiungere i prodotti che vuoi tenere sotto monitoraggio grazie alla nostra
    applicazione: sfruttiamo le API dei nostri partner per procurarci informazioni precedenti all'iscrizione dei
    nostri clienti sulla nostra piattaforma
@endsection

@section('content')
    <div id="products">
        <div class="hidden horizzontal">
            <h1>prodotti seguiti</h1>
        </div>

        <div id="followed" class="hidden"></div>

        <div class="horizzontal">
            <h1>tutti i prodotti</h1>
            <form name="search">
                <input name="query" type="text" placeholder="inserisci nome prodotto">
                <input type="submit" class="buttonBlack1" value="cerca prodotto">
            </form>
        </div>

        <div id="unfollowed"></div>
    </div>
@endsection



