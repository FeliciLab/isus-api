<?php

namespace App\Model\Sagu;

use Illuminate\Database\Eloquent\Model;

class SaguUserInfo extends Model
{
    protected $table = 'sagu_user_infos';

    protected $fillable = [
        'user_id',
        'componente',
        'programa_residencia',
        'municipio_residencia',
    ];
}
