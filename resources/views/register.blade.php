@extends('layout.auth')

@section('title')
    Registrati
@endsection

@section('scripts')
    <script src="{{ asset('js/signup_check.js') }}" defer></script>
@endsection

@section('welcome_message')
    Registrati adesso al servizio: il primo mese è gratis!
@endsection

{{--TODO: Garantire l'accesso pure ai guest per visionare la home--}}

@section('form_div')
    <div id="sign_div" class="sign_up">
        <img src="{{ asset('images/logo/ConBoxBlack.png') }}" class="logo_64" alt="conbox logo">
        <form name="register" method="post" action="{{ route('register') }}">
            @csrf
            <div class="input_div">
                <label for="name">Nome</label><input name="name" type="text" placeholder="max 30 caratteri"
                                                     class="input_txt">
            </div>
            <div class="input_div">
                <label for="surname">Cognome</label><input name="surname" type="text" placeholder="max 30 caratteri"
                                                           class="input_txt">
            </div>

            <div class="input_div">
                <label for="company">Nome Impresa</label><input name="company" type="text"
                                                                placeholder="max 30 caratteri" class="input_txt">
            </div>

            <div class="input_div">
                <label for="city">Città Sede</label><input name="city" type="text" placeholder="max 30 caratteri"
                                                           class="input_txt">
            </div>

            <div class="input_div">
                <label for="address">Indirizzo Sede</label><input name="address" type="text"
                                                                  placeholder="max 50 caratteri" class="input_txt">
            </div>

            <div class="input_div">
                <label for="email">Email</label><input name="email" type="text" placeholder="es: abc123@provider.com"
                                                       class="input_txt">
            </div>

            <div class="input_div">
                <label for="password">Password</label><input name="password" type="password"
                                                             placeholder="min 8 caratteri [A-Za-z0-9@#+.]"
                                                             class="input_txt">
            </div>

            <div class="input_div">
                <label for="retype-password">Reinserisci password</label><input name="retype-password" type="password"
                                                                                placeholder="reinserisci password"
                                                                                class="input_txt">
            </div>

            <div class="input_div">
                <label for="iva">Partita iva</label><input name="iva" type="text" placeholder="deve contenere 11 cifre"
                                                           class="input_txt">
            </div>

            <input value="Registrati" type="submit" class="buttonBlack1">
            <span>Sei già registrato? <a href="{{ route('login') }}">Clicca qui per il login</a>!</span>
        </form>

        {{--TODO: Rimuovere l'array degli errori lato server dal controller--}}

        <div class="error hidden"></div>

    </div>
@endsection
