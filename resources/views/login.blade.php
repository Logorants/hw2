@extends('layout.auth')

@section('title')
    Login
@endsection

@section('welcome_message')
    Bentornato/a! Effettua qui il login
@endsection

@section('form_div')
    <div id="sign_div" class="sign_in">
        <img src="{{ asset('images/logo/ConBoxBlack.png') }}" class="logo_64" alt="conbox logo">
        <form name="login" method="post" action="{{ route('login') }}">
            @csrf
            <div class="input_div">
                <label for="email">indirizzo e-mail</label><input name="email" type="email" class="input_txt">
            </div>
            <div class="input_div">
                <label for="password">Password</label><input name="password" type="password" class="input_txt">
            </div>
            <input value="Login" type="submit" class="buttonBlack1">
            <span>Non sei ancora registrato? <a href="{{ route('register') }}">Clicca qui</a>!</span>
        </form>
    </div>
@endsection
