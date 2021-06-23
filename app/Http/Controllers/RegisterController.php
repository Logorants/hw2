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
        $error = array();
        $req = request();

        if ($this->validateForm($form_validate, $req, $error)) {

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

    function validateForm($form_validate, $request, $error): bool
    {
        $form_validate['name'] = $this->checkName($request['name'], $error);
        $form_validate['surname'] = $this->checkSurname($request['surname'], $error);
        $form_validate['company'] = $this->checkCompany($request['company'], $error);
        $form_validate['city'] = $this->checkCity($request['city'], $error);
        $form_validate['address'] = $this->checkAddress($request['address'], $error);
        $form_validate['email'] = $this->checkEmail($request['email'], $error);
        $form_validate['password'] = $this->checkPassword($request['password'], $error);
        $form_validate['retype-password'] = $this->checkRePassword($request['password'], $request['retype-password'], $error);
        $form_validate['iva'] = $this->checkIVA($request['iva'], $error);

        foreach ($form_validate as $data) {
            if (!$data) return false;
        }
        return true;
    }

    function checkName($name, $error): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $name)) {
            array_push($error, "la lunghezza del nome deve essere tra i 3 ed i 30 caratteri");
            return false;
        } else return true;
    }

    function checkSurname($surname, $error): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $surname)) {
            array_push($error, "la lunghezza del cognome deve essere tra i 3 ed i 30 caratteri");
            return false;
        } else return true;
    }

    function checkCompany($company, $error): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $company)) {
            array_push($error, "la lunghezza del nome dell'impresa deve essere compresa tra i 3 ed i 30 caratteri");
            return false;
        } else return true;
    }

    function checkCity($city, $error): bool
    {
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,30}$/", $city)) {
            array_push($error, "la lunghezza del nome della città deve essere compresa tra i 3 ed i 50 caratteri e non può contenere numeri");
            return false;
        } else return true;
    }

    function checkAddress($address, $error): bool
    {
        if (!preg_match("/^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50}$/", $address)) {
            array_push($error, "l'indirizzo della sede deve avere min 3 caratteri e max 50 caratteri");
            return false;
        } else return true;
    }

    function checkEmail($email, $error): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($error, "formato email errato");
            return false;
        }

        $exist = UtenteConbox::query()->where('email', $email)->exists();

        if ($exist) {
            array_push($error, "l'account associato a questa email è già stato registrato");
            return false;
        }

        return true;
    }

    function checkPassword($pass, $error): bool
    {
        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass)) {
            array_push($error, "la password deve essere lunga almeno 8 caratteri ed avere almeno 1 carattere maiuscolo e minuscolo, 1 simbolo speciale ed 1 numero");
            return false;
        } else return true;
    }

    function checkRePassword($pass, $repass, $error): bool
    {
        if (strcmp($pass, $repass) != 0) {
            array_push($error, "le password non corrispondono");
            return false;
        } else return true;
    }

    function checkIVA($iva, $error): bool
    {
        if (!preg_match("/^[0-9]{11}$/", $iva)) {
            array_push($error, "la partita IVA è costituita da 11 cifre");
            return false;
        } else return true;
    }
}
