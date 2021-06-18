<?php

namespace App\Repository;

use App\Model\DefinicoesConteudos\DefinicoesConteudo;
use App\Model\DefinicoesConteudos\DefinicoesConteudoOpcoes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DefinicoesConteudosRepository
{
    /**
     * @var DefinicoesConteudo
     */
    private $model;

    /**
     * @var DefinicoesConteudosOpcoesRepository
     */
    private $opcoesRepository;

    public function __construct()
    {
        $this->model = new DefinicoesConteudo();
        $this->opcoesRepository = new DefinicoesConteudosOpcoesRepository();
    }

    public function buscar(string $categoria, string $id_publico = '')
    {
        $consulta = $this->model
            ->ativos()
            ->emOrdem()
            ->where('categoria', $categoria)
            ->with('opcoes:id,definicoes_conteudos_id,chave,valor');

        if ($id_publico !== '') {
            $consulta->where('id_publico', $id_publico);
        }

        return $consulta->get();
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

        return $defConteudo;
    }

    public function atualizar(array $dados, DefinicoesConteudo $definicoesConteudo)
    {
        $resultado = new DefinicoesConteudo();
        DB::transaction(function () use ($dados, $definicoesConteudo, &$resultado) {
            $this->opcoesRepository->deletarOpcoesDeUmaDefinicoesConteudos($definicoesConteudo->id);

            if (Arr::get($dados, 'opcoes', false)) {
                $this->opcoesRepository->inserirOpcoes($definicoesConteudo->id, Arr::get($dados, 'opcoes', []));
            }

            $resultado = $definicoesConteudo->update($dados);
        });

        return $resultado;
    }

    public function deletar(string $categoria, string $id_publico)
    {
        $definicoesConteudo = $this->model->where('categoria', $categoria)->where('id_publico', $id_publico)->first();
        return DB::transaction(function () use ($definicoesConteudo) {
            $this->opcoesRepository->deletarOpcoesDeUmaDefinicoesConteudos($definicoesConteudo->id);
            $definicoesConteudo->delete();
        });
    }
}
