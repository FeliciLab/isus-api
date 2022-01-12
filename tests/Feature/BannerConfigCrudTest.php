<?php

namespace Tests\Feature;

use App\Model\BannerConfig;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BannerConfigCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deve_retornar_lista_completa()
    {
        $this->get('/api/banner-config')
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) => $json->first(
                    fn ($json) => $json->has('id')
                        ->has('titulo')
                        ->has('imagem')
                        ->has('valor')
                        ->has('tipo')
                        ->has('ordem')
                        ->has('options')
                        ->has('ativo')
                        ->missing('updated_at')
                        ->missing('created_at')
                )
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deve_buscar_config_id1_com_os_campos_e_valores_corretos_de_acord_com_seeder()
    {
        $this->get('/api/banner-config/1')
            ->assertStatus(200)
            ->assertExactJson(
                [
                    'id' => 1,
                    'ativo' => true,
                    'titulo' => 'Vacinação',
                    'imagem' => 'images/banners/vacinaCovid19.png',
                    'valor' => 'https://coronavirus.ceara.gov.br/vacina',
                    'tipo' => 'webview',
                    'ordem' => 1,
                    'options' => json_encode(['local_imagem' => 'app']),
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_inserir_novo_banner_config()
    {
        $this->postJson(
            '/api/banner-config',
            [
                'titulo' => 'Meu teste de API',
                'imagem' => 'images/banners/guiaAssistenciaFarmaceutica.jpg',
                'valor' => "https =>//coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara\/",
                'tipo' => 'webview',
                'ordem' => 5,
                'ativo' => 1,
                'options' => json_encode(['local_imagem' => 'app']),

            ]
        )
            ->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validacao_ao_inserir_banner_config()
    {
        $this->postJson('/api/banner-config', [])
            ->assertExactJson(
                [
                    'titulo.0' => 'O campo titulo é obrigatório.',
                    'imagem.0' => 'O campo imagem é obrigatório.',
                    'valor.0' => 'O campo valor é obrigatório.',
                    'tipo.0' => 'O campo tipo é obrigatório.',
                    'ordem.0' => 'O campo ordem é obrigatório.',
                    'options.0' => 'O campo options é obrigatório.',
                    'ativo.0' => 'O campo ativo é obrigatório.',
                ]
            )
            ->assertStatus(400);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_atualizar_o_ultimo_banner_inserido()
    {
        $this->putJson(
            '/api/banner-config/' .
            BannerConfig::select('id')
                ->orderBy('id', 'desc')
                ->get()
                ->first()
                ->id,
            [
                'titulo' => 'Meu teste atualizando API',
                'imagem' => 'images/banners/guiaAssistenciaFarmaceutica.jpg',
                'valor' => "https =>//coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara\/",
                'tipo' => 'webview',
                'ordem' => 6,
                'ativo' => 0,
                'options' => json_encode(['local_imagem' => 'app']),
            ]
        )
            ->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_remover_o_ultimo_banner_inserido()
    {
        $this->delete(
            '/api/banner-config/' .
            BannerConfig::select('id')
                ->orderBy('id', 'desc')
                ->get()
                ->first()
                ->id
        )
            ->assertStatus(204);
    }
}
