<?php

namespace App\Http\Controllers;

use App\Models\UtenteConbox;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        if (session('user')) return redirect('home');
        else return view('register')->with('csrf_token', csrf_token());
    }

    public function register()
    {
        $form_validate = [
            'name' => false,
            'surname' => false,
            'company' => false,
            'city' => false,
            'address' => false,
            'email' => false,
            'password' => false,
            'retype-password' => false,
            'iva' => false
        ];

        $req = request();

        if ($this->validateForm($form_validate, $req)) {

            $user = UtenteConbox::create([
                'nome' => $req['name'],
                'cognome' => $req['surname'],
                'partita_iva' => $req['iva'],
                'email' => $req['email'],
                'password' => $req['password'],
                'nome_impresa' => $req['company'],
                'città_sede' => $req['city'],
                'indirizzo_sede' => $req['address']
            ]);

            session(['user' => $user['id']]);
            return redirect('home');

        } else{
            return view('register', [
                'error' => $error,
                'csrf_token' => csrf_token()
            ]);
        }
    }

    //Fields validation

    function validateForm($form_validate, $request): bool
    {
        $form_validate['name'] = $this->checkName($request['name']);
        $form_validate['surname'] = $this->checkSurname($request['surname']);
        $form_validate['company'] = $this->checkCompany($request['company']);
        $form_validate['city'] = $this->checkCity($request['city']);
        $form_validate['address'] = $this->checkAddress($request['address']);
        $form_validate['email'] = $this->checkEmail($request['email']);
        $form_validate['password'] = $this->checkPassword($request['password']);
        $form_validate['retype-password'] = $this->checkRePassword($request['password'], $request['retype-password']);
        $form_validate['iva'] = $this->checkIVA($request['iva']);

        foreach ($form_validate as $data) {
            if (!$data) return false;
        }
        return true;
    }

    function checkName($name): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $name)) {
            return false;
        } else return true;
    }

    function checkSurname($surname): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $surname)) {
            return false;
        } else return true;
    }

    function checkCompany($company): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $company)) {
            return false;
        } else return true;
    }

    function checkCity($city): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $city)) {
            return false;
        } else return true;
    }

    function checkAddress($address): bool
    {
        if (!preg_match("/^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50}$/", $address)) {
            return false;
        } else return true;
    }

    function checkEmail($email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $exist = UtenteConbox::query()->where('email', $email)->exists();

        if ($exist) {
            return false;
        }

        return true;
    }

    function checkPassword($pass): bool
    {
        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass)) {
            array_push($error, "la password deve essere lunga almeno 8 caratteri ed avere almeno 1 carattere maiuscolo e minuscolo, 1 simbolo speciale ed 1 numero");
            return false;
        } else return true;
    }

    function checkRePassword($pass, $repass): bool
    {
        if (strcmp($pass, $repass) != 0) {
            array_push($error, "le password non corrispondono");
            return false;
        } else return true;
    }

    function checkIVA($iva): bool
    {
        if (!preg_match("/^[0-9]{11}$/", $iva)) {
            array_push($error, "la partita IVA è costituita da 11 cifre");
            return false;
        } else return true;
    }
}
