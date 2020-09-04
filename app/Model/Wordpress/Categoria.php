<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function categoriaProjetos()
    {
        return $this->hasMany(CategoriaProjeto::class, 'categoria_id', 'term_id');
    }
}
