<?php

namespace App\Http\Controllers;

use App\Models\UtenteConbox;
use Illuminate\Http\Client\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

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

    public function search_news(): Response
    {
        $endpoint = "https://newsapi.org/v2/everything";

        return Http::get($endpoint, [
            'q' => 'ecommerce',
            'language' => 'it',
            'pageSize' => 5,
            'apiKey' => env('NEWSAPI_KEY')
        ]);
    }
}
