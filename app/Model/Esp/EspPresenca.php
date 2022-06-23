<?php

namespace App\Model\Esp;

use Illuminate\Database\Eloquent\Model;

class EspPresenca extends Model
{
    protected $table = 'esp_presencas';

    protected $dates = [
        'data',
    ];

    protected $fillable = [
        'user_id',
        'esp_oferta_id',
        'data',
    ];
}
