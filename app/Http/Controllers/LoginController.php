<?php

namespace App\Http\Controllers;

use App\Models\UtenteConbox;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function index(){
        if(session('user')){
            return redirect('home');
        }
        else {
            return view("login")->with('csrf_token', csrf_token());
        }
    }

    public function auth(){
        $req = request();
        $pass = $req['password'];
        $pass = hash('sha256', $pass);
        $pass = base64_encode($pass);
        $user = UtenteConbox::where('email', $req['email'])->where('password', $pass)->first();

        if($user !== null){
            session(['user' => $user['id']]);
            return redirect('home');
        }
        else{
            return redirect('login')->withInput();
        }
    }

    public function logout(){
        session()->flush();
        return redirect('login');
    }
}
