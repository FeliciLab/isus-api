<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servico';

    protected $hidden = ['created_at', 'updated_at'];
}
