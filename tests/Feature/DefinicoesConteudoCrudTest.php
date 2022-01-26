<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DefinicoesConteudoCrudTest extends TestCase
{
    /**
     * @var string
     */
    private $rotaElmo = '/api/definicoes-conteudos/elmo';

    public function test_deve_retornar_lista_completa_para_elmo()
    {
        $this->get($this->rotaElmo)
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json->first(
                    fn ($json) => $json->has('id')
                        ->has('id_publico')
                        ->has('ativo')
                        ->has('categoria')
                        ->has('imagem')
                        ->has('ordem')
                        ->has('sessao')
                        ->has('tipo')
                        ->has('titulo')
                        ->has('valor')
                        ->has('opcoes')
                        ->missing('updated_at')
                        ->missing('created_at')
                )
            );
    }

    public function test_buscar_por_id_publico()
    {
        $this->get($this->rotaElmo . '/elmo_treinamento')
            ->assertOk()
            ->assertExactJson(
                [
                    [
                      'id' => 1,
                      'id_publico' => 'elmo_treinamento',
                      'ativo' => true,
                      'categoria' => 'elmo',
                      'imagem' => 'SvgCapacitacao',
                      'ordem' => 1,
                      'sessao' => 'conteudos',
                      'tipo' => 'webview',
                      'titulo' => 'Treinamento',
                      'valor' => 'https://sus.ce.gov.br/elmo/faca-sua-capacitacao/',
                      'opcoes' => [
                        'localImagem' => 'app',
                        'labelAnalytics' => 'elmo_card_treinamento',
                      ],
                    ],
                  ]
            );
    }

    public function test_inserir_nova_definicao_conteudo()
    {
        $this->postJson(
            $this->rotaElmo,
            [
                'id_publico' => 'teste_conteudo',
                'ativo' => true,
                'categoria' => 'elmo',
                'imagem' => 'SvgCapacitacao',
                'ordem' => 9999,
                'sessao' => 'conteudos',
                'tipo' => 'webview',
                'titulo' => 'Treinamento',
                'valor' => 'https://sus.ce.gov.br/elmo/faca-sua-capacitacao/',
                'opcoes' => [
                    'localImagem' => 'app',
                    'labelAnalytics' => 'teste_conteudo_analytics',
                ],
            ]
        )
            ->assertCreated();
    }

    public function test_atualizar_definicao_conteudo()
    {
        $this->putJson(
            $this->rotaElmo . '/teste_conteudo',
            [
                'ativo' => false,
            ]
        )
            ->assertOk();
    }

    public function test_remover_uma_definicao_conteudo()
    {
        $this->delete($this->rotaElmo . '/teste_conteudo')
            ->assertNoContent();
    }
}
