<?php

namespace App\Model\Wordpress;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projetos';

    protected $fillabel = [
        'id',
        'post_link',
        'data',
        'post_title',
        'slug',
        'content',
        'image',
    ];

    public function categoriaProjeto()
    {
        return $this->belongsTo(CategoriaProjeto::class);
    }

    public function anexos()
    {
        return $this->hasMany('App\Model\Wordpress\Anexo');
    }
}
