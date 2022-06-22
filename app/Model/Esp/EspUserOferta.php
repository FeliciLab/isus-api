<?php

namespace App\Model\Esp;

use Illuminate\Database\Eloquent\Model;

class EspUserOferta extends Model
{
    protected $table = 'esp_user_ofertas';

    protected $fillable = [
        'user_id',
        'esp_oferta_id',
    ];
}
