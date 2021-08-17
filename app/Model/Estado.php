<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps = false;
    protected $table = 'estados';
    protected $fillable = [
        'id',
        'nome',
        'uf',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}
