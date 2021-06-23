<?php

namespace App\Service;

use App\Repository\DefinicoesConteudosRepository;

class DefinicoesConteudosService
{
    /**
     * @var App\Service\DefinicoesConteudosRepository
     */
    private $repository;

    /**
     * @var DefinicoesConteudosOpcoesService
     */
    private $opcoesService;

    public function __construct()
    {
        $this->repository = new DefinicoesConteudosRepository();
        $this->opcoesService = new DefinicoesConteudosOpcoesService();
    }

    public function buscar(string $categoria, string $id_publico = '')
    {
        return $this->repository->buscar($categoria, $id_publico)
            ->map(function ($item) {
                $opcoes = [];
                foreach ($item->opcoes as $op) {
                    $opcoes[$op->chave] = $op->valor;
                }

                $dados = [];
                foreach (collect($item) as $chave => $valor) {
                    if ($chave === 'opcoes') {
                        $dados['opcoes'] = $opcoes;
                        continue;
                    }

                    $dados[$chave] = $valor;
                }

                return $dados;
            });
    }

    public function salvar(array $dados)
    {
        return $this->repository->salvar($dados)->id;
    }

    public function atualizar(string $categoria, string $id_publico, array $dados)
    {
        $definicoesConteudo = $this->repository->buscar($categoria, $id_publico)->get(0);

        return $this->repository->atualizar($dados, $definicoesConteudo);
    }

    public function deletar(string $categoria, string $id_publico)
    {
        return $this->repository->deletar($categoria, $id_publico);
    }
}
