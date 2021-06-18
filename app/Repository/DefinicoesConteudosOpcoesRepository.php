<?php

namespace App\Repository;

use App\Model\DefinicoesConteudos\DefinicoesConteudoOpcoes;

class DefinicoesConteudosOpcoesRepository
{
    /**
     * @var DefinicoesConteudosOpcoes
     */
    private $model;

    public function __construct()
    {
        $this->model = new DefinicoesConteudoOpcoes();
    }

    public function deletarMuitos(array $ids)
    {
        $this->model
            ->whereIn('definicoes_conteudos_id', $ids)
            ->delete();
    }

    public function inserirOpcoes(int $idDefConteudos, array $opcoes)
    {
        foreach ($opcoes as $chave => $valor) {
            $this->model::create(
                [
                    'definicoes_conteudos_id' => $idDefConteudos,
                    'chave' => $chave,
                    'valor' => $valor,
                ]
            );
        }
    }

    public function deletarOpcoesDeUmaDefinicoesConteudos(int $idDefConteudos)
    {
        return $this->model->where('definicoes_conteudos_id', $idDefConteudos)->delete();
    }
}
