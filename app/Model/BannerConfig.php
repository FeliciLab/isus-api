<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BannerConfig extends Model
{
    protected $table = 'banner_config';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'titulo',
        'imagem',
        'valor',
        'tipo',
        'ordem',
        'options',
        'ativo'
    ];

    protected $cast = [
        'ativo' => 'boolean',
        'ordem' => 'integer'
    ];
}
