<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function municipio()
    {
        return $this->hasOne(Municipio::class);
    }

    public function categoriaProfissional()
    {
        return $this->hasOne(CategoriaProfissional::class);
    }

    public function unidadesServicos()
    {
        return $this->hasMany(UserUnidadeServico::class);
    }
}
