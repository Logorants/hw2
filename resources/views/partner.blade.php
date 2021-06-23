@extends('layout.app')

@section('title')
    Partner
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/partner.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/partner_script.js') }}" defer></script>
@endsection

@section('title_main')
    Partner
@endsection

@section('desc_main')
    Controlla in tempo reale la situazione finanziaria dei nostri partner e le news sul mondo dell'e-commerce
@endsection

@section('content')
    <div id="finance"></div>

    <div id="news">
        <h1>articoli</h1>
        <div class="articles_shelf"></div>
    </div>
@endsection
