<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;

class CategoriaProjeto extends Model
{
    public $timestamps = false;
    protected $table = 'categorias_projetos';

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'id', 'projeto_id');
    }
}
