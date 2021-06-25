<?php

namespace App\Http\Controllers;

use App\Models\UtenteConbox;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    function index() {
        if(session('user')) {
            $user = UtenteConbox::find(session('user'));
            return view('home', [
                'name' => $user['nome'],
                'surname' => $user['cognome']
            ]);
        }
        else return view('home');
    }
}
