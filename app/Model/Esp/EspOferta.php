<?php

namespace App\Model\Esp;

use Illuminate\Database\Eloquent\Model;

class EspOferta extends Model
{
    protected $table = 'esp_ofertas';

    protected $fillable = [
        'nome',
        'carga_horaria',
        'is_active',
        'inicio',
        'fim',
    ];
}
