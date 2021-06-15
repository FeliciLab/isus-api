<?php

namespace App\Service;

use App\Model\DefinicoesConteudos\DefinicoesConteudo;
use App\Model\DefinicoesConteudos\DefinicoesConteudoOpcoes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DefinicoesConteudosService
{
    public function buscar(string $categoria)
    {
        return (new DefinicoesConteudo())
            ->where('categoria', $categoria)
            ->with('opcoes:definicoes_conteudos_id,chave,valor')
            ->get()
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
        $defConteudo = collect();
        DB::transaction(function () use ($dados, &$defConteudo) {
            $defConteudo = DefinicoesConteudo::create($dados);
            if (Arr::get($dados, 'opcoes', false)) {
                foreach ($dados['opcoes'] as $chave => $valor) {
                    DefinicoesConteudoOpcoes::create(
                        [
                            'definicoes_conteudos_id' => $defConteudo->id,
                            'chave' => $chave,
                            'valor' => $valor,
                        ]
                    );
                }
            }
        });

        return $defConteudo->id;
    }
}
