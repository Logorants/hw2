<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User;

class UtenteConbox extends User
{
    protected $table = "utente_conbox";
    public $timestamps = false;
    protected $fillable = [
        "nome",
        "cognome",
        "partita_iva",
        "email",
        "password",
        "nome_impresa",
        "città_sede",
        "indirizzo_sede"
    ];
    protected $hidden = [
        "password"
    ];

    public function prodotto(): BelongsToMany
    {
        return $this->belongsToMany(Prodotto::class, 'monitoraggio', 'utente_conbox', 'prodotto', 'id', 'ean13')
            ->withPivot('data_inizio_monitoraggio');
    }
}
