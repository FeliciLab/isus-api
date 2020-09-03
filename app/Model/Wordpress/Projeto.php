<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    public function categoria()
    {
        return $this->belongsTo('App\Model\Wordpress\Categoria');
    }

    public function anexos()
    {
        return $this->hasMany('App\Model\Wordpress\Anexo');
    }
}
