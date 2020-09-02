<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;

class CategoriaProjeto extends Model
{
    protected $table = 'categorias_projetos';
    public $timestamps = false;

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'id', 'projeto_id');
    }
}
