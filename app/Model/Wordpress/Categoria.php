<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Categoria extends Model
{
    public function projetos()
    {
        return $this->hasMany('App\Model\Wordpress\Projeto', 'categoria_id', 'term_id');
    }
}
