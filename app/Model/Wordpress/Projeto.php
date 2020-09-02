<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Projeto extends Model
{
    public function categoriaProjeto()
    {
        return $this->belongsTo(CategoriaProjeto::class);
    }

    public function anexos()
    {
        return $this->hasMany('App\Model\Wordpress\Anexo');
    }
}
