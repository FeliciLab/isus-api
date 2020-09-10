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
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    public function categoriaProfissional()
    {
        return $this->hasOne(CategoriaProfissional::class, 'id', 'categoriaprofissional_id');
    }

    public function unidadesServicos()
    {
        return $this->hasMany(UserUnidadeServico::class);
    }

    public function titulacoesAcademicas()
    {
        return $this->hasMany(UserTitulacaoAcademica::class);
    }

    public function tiposContratacoes()
    {
        return $this->hasMany(UserTipoContratacao::class);
    }

    public function dadosUsuario()
    {
        $municipio = $this->municipio()->first();
        $estado = $municipio->estado()->first();
        $categoriProfissional = $this->categoriaProfissional()->first();

        $tiposContratacoes = [];
        $titulacoesAcademica = [];
        $unidadesDeServicos = [];

        foreach ($this->tiposContratacoes()->get() as $tipoContratacao) {
            $tiposContratacoes[] = $tipoContratacao->tipoContratacao()->first();
        }

        foreach ($this->titulacoesAcademicas()->get() as $titulacaoAcademica) {
            $titulacoesAcademica[] = $titulacaoAcademica->titulacaoAcademica()->first();
        }

        foreach ($this->unidadesServicos()->get() as $unidadeDeServico) {
            $unidadesDeServicos[] = $unidadeDeServico->unidadeServico()->first();
        }

        $dadosUsuario = [
            'id' => $this->id,
            'id_keycloak' => $this->id_keycloak,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'municipio' => $municipio,
            'estado' => $estado,
            'profissional' => [
                'categoria_profissional' => $categoriProfissional,
                'tipos_contratacoes' => $tiposContratacoes,
                'titulacoes_academica' => $titulacoesAcademica,
                'unidades_servicos' => $unidadesDeServicos,
            ],
        ];

        return $dadosUsuario;
    }
}
