<?php

namespace App\Service;

use App\Model\DefinicoesConteudos\DefinicoesConteudo;
use App\Model\DefinicoesConteudos\DefinicoesConteudoOpcoes;
use App\Repository\DefinicoesConteudoRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DefinicoesConteudosService
{
    /**
     * @var DefinicoesConteudosRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new DefinicoesConteudoRepository();
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
        $definicoesConteudo = $this->repository->buscar($categoria, $id_publico);
        $definicoesConteudo->fill($dados);
        $definicoesConteudo->save();

        $opcoes = $definicoesConteudo->opcoes;
        foreach ($opcoes as $opcao) {
            foreach ($dados['opcoes'] as $chave => $valor) {
                $op = $opcao->find(function ($item) use ($chave) {
                    return $item->chave === $chave;
                });

                if (!$op) {
                    $opcao->delete();
                    continue;
                }

                $op->valor = $valor;
                $op->save();
            }

        }

    }
}
