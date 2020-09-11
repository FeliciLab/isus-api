<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $hidden = ['created_at', 'updated_at'];
}
