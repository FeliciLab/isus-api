<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}
