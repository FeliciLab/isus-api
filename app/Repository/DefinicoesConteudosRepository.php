<?php
namespace App\Repository;

use App\Model\DefinicoesConteudos\DefinicoesConteudo;
use App\Model\DefinicoesConteudos\DefinicoesConteudoOpcoes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DefinicoesConteudoRepository
{
    /**
     * @var DefinicoesConteudo
     */
    private $model;

    public function __construct()
    {
        $this->model = new DefinicoesConteudo();
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
}
