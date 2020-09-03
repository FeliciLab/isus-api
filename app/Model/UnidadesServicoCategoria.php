<?php

namespace App\Model;

use App\Model\Wordpress\Categoria;
use Illuminate\Database\Eloquent\Model;

class UnidadesServicoCategoria extends Model
{
    public $timestamps = false;
    protected $table = 'unidades_servico_categoria';

    const WORDPRESS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE = 697;
    const WORDPRESS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO = 698;
    const WORDPRESS_CATEGORIA_APOIO_TECNICO = 699;
    const WORDPRESS_CATEGORIA_ADMINISTRACAO_E_GESTAO = 700;

    public function servico() {
        return $this->belongsTo(UnidadeServico::class);
    }
    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'term_id');
    }
}
