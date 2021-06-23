<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\UtenteConbox;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Psy\Util\Json;

class ServicesController extends Controller
{
    function index()
    {
        if (session("user")) {
            $user = UtenteConbox::find(session('user'));
            return view('servizi', [
                'name' => $user['nome'],
                'surname' => $user['cognome']
            ]);
        } else return redirect('login');
    }

    function search($query)
    {
        $response = Http::get('https://svcs.ebay.com/services/search/FindingService/v1', [
                'OPERATION-NAME' => 'findItemsByKeywords',
                'SECURITY-APPNAME' => env('EBAY_SECURITY_APPNAME'),
                'GLOBAL-ID' => 'EBAY-IT',
                'RESPONSE-DATA-FORMAT' => 'JSON',
                'keywords' => $query,
                'outputSelector' => 'SellerInfo',
                'itemFilter.name' => 'MinPrice',
                'itemFilter.paramName' => 'Currency',
                'itemFilter.paramValue' => 'EUR',
                'itemFilter.value' => 0.0,
                'paginationInput.entriesPerPage' => 12,
                'paginationInput.pageNumber' => 1]
        );

        if ($response->failed()) abort(500);

        return $response;
    }

    public function add()
    {
        $req = request();

        if(!Prodotto::find($req['id'])){

            $prod = Prodotto::create([
                'ean13' => $req['id'],
                'nome' => $req['pn'],
                'prezzo' => $req['p'],
                'recensione' => $req['rw'],
                'img' => $req['img'],
                'link' => $req['link']
            ]);
        } else $prod = Prodotto::find($req['id']);

        UtenteConbox::find(session('user'))->prodotto()->save($prod);
    }

    public function load(): JsonResponse
    {
        $user = UtenteConbox::find(session('user'));
        $results = $user->prodotto()->get();
        return response()->json($results);
    }

    public function check($itemid): JsonResponse
    {
        $check = UtenteConbox::find(session('user'))->prodotto()->where('prodotto', $itemid)->exists();
        return response()->json(['check' => $check]);
    }

    public function delete()
    {
        $req = request();
        UtenteConbox::find(session('user'))->prodotto()->where('prodotto', $req['itemid'])->delete();
    }

    public function prodcheck($itemid)
    {
        $check = ['check' => Prodotto::where('ean13', $itemid)->exists()];
        return response()->json($check);
    }
}
