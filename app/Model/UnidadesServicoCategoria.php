<?php

namespace App\Model;

use App\Model\Wordpress\Categoria;
use Illuminate\Database\Eloquent\Model;

class UnidadesServicoCategoria extends Model
{
    public const WORDPRESS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE = 697;
    public const WORDPRESS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO = 698;
    public const WORDPRESS_CATEGORIA_APOIO_TECNICO = 699;
    public const WORDPRESS_CATEGORIA_ADMINISTRACAO_E_GESTAO = 700;
    public $timestamps = false;
    protected $table = 'unidades_servico_categoria';

    public function servico()
    {
        return $this->belongsTo(UnidadeServico::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'term_id');
    }
}
