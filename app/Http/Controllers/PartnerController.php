<?php

namespace App\Http\Controllers;

use App\Models\UtenteConbox;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class PartnerController extends Controller
{
    public function index()
    {
        if (session('user')) {
            $user = UtenteConbox::find(session('user'));
            return view('partner', [
                'name' => $user['nome'],
                'surname' => $user['cognome']
            ]);
        } else return redirect('login');
    }

    public function search_details(): JsonResponse
    {
        $endpoint = "https://finnhub.io/api/v1/stock/profile2";
        $symbols = array("AMZN", "EBAY", "BIGC", "ETSY", "GRPN", "SSTK");
        $json = array();

        foreach ($symbols as $symbol) {
            $resp = Http::get($endpoint, [
                'symbol' => $symbol,
                'token' => env('FINNHUB_API_KEY')
            ]);

            if($resp->failed()) abort('500');
            else array_push($json, $resp->json());
        }

        return response()->json($json);

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
