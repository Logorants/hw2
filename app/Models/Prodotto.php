<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prodotto extends Model
{
    public $incrementing = false;
    protected $table = "prodotto";
    protected $primaryKey = "ean13";
    protected $keyType = "String";
    public $timestamps = false;
    protected $fillable = [
        'ean13',
        'nome',
        'prezzo',
        'recensione',
        'img',
        'link'
    ];

    public function utente_conbox(): BelongsToMany
    {
        return $this->belongsToMany(UtenteConbox::class, "monitoraggio", "prodotto", "utente_conbox", "ean13", "id")
            ->withPivot("data_inizio_monitoraggio");
    }
}
