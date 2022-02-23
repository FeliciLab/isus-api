<?php

namespace App\Model\Sagu;

use Illuminate\Database\Eloquent\Model;

class SaguPresenca extends Model
{
    protected $table = 'sagu_presencas';

    protected $fillable = [
        'user_id',
        'sagu_oferta_id',
        'data',
        'turno',
    ];
}
