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
        'id_keycloak',
        'name',
        'email',
        'password',
        'cpf',
        'telefone',
        'municipio_id',
        'categoriaprofissional_id',
        'email_verified_at',
        'updated_at',
        'created_at'
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

    public function especialidades()
    {
        return $this->hasMany(UserEspecialidade::class);
    }

    public function dadosUsuario()
    {
        $municipio = $this->municipio()->first();
        $estado = $municipio->estado()->first();
        $categoriProfissional = $this->categoriaProfissional()->first();

        $tiposContratacoes = [];
        $titulacoesAcademica = [];
        $unidadesDeServicos = [];
        $especialidades = [];

        foreach ($this->tiposContratacoes()->get() as $tipoContratacao) {
            $tiposContratacoes[] = $tipoContratacao->tipoContratacao()->first();
        }

        foreach ($this->titulacoesAcademicas()->get() as $titulacaoAcademica) {
            $titulacoesAcademica[] = $titulacaoAcademica->titulacaoAcademica()->first();
        }

        foreach ($this->unidadesServicos()->get() as $unidadeDeServico) {
            $unidadesDeServicos[] = $unidadeDeServico->unidadeServico()->first();
        }

        foreach ($this->especialidades()->get() as $especialidade) {
            $especialidades[] = $especialidade->especialidade()->first();
        }

        $dadosUsuario = [
            'id' => $this->id,
            'id_keycloak' => $this->id_keycloak,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'municipio' => $municipio,
            'estado' => $estado,
            'profissional' => [
                'categoria_profissional' => $categoriProfissional,
                'tipos_contratacoes' => $tiposContratacoes,
                'titulacoes_academica' => $titulacoesAcademica,
                'unidades_servicos' => $unidadesDeServicos,
                'especialidades' => $especialidades,
            ],
        ];

        return $dadosUsuario;
    }

    public function remover()
    {
        foreach ($this->tiposContratacoes()->get() as $tipoContratacao) {
            $tipoContratacao->delete();
        }

        foreach ($this->titulacoesAcademicas()->get() as $titulacaoAcademica) {
            $titulacaoAcademica->delete();
        }

        foreach ($this->unidadesServicos()->get() as $unidadeDeServico) {
            $unidadeDeServico->delete();
        }

        foreach ($this->especialidades()->get() as $especialidade) {
            $especialidade->delete();
        }

        return $this->delete();
    }
}
