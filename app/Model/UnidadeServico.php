<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UnidadeServico extends Model
{
    public const ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE = 1;
    public const ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO = 2;
    public const ISUS_CATEGORIA_APOIO_TECNICO = 3;
    public const ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO = 4;
    protected $table = 'unidades_servico';

    public function unidadesServicoCategoria()
    {
        return $this->hasMany(UnidadesServicoCategoria::class);
    }

    public static function pegarMacroUnidadeDeServico($unidadesDeSaude)
    {
        $macroUnidadesDeSaude = [];
        foreach ($unidadesDeSaude as $UnidadeDeServico) {
            $macroUnidadesDeSaude[] = self::where('id', $UnidadeDeServico)->first()->pai;
        }

        $macroUnidadesDeSaude = array_unique($macroUnidadesDeSaude);

        return self::whereIn('id', $macroUnidadesDeSaude)->get();
    }
}
