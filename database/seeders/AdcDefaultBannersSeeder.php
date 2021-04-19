<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdcDefaultBannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner_config')->insert([
            [
                'ativo' => true,
                'titulo' => 'Vacinação',
                'imagem' => 'images/banners/vacinaCovid19.png',
                'valor' => 'https://coronavirus.ceara.gov.br/vacina',
                'tipo' => 'webview',
                'ordem' => 1,
                'options' => json_encode(['local_imagem' => 'app']),
            ],
            [
                'ativo' => true,
                'titulo' => 'Guia de Assistência Farmacêutica',
                'imagem' => 'images/banners/guiaAssistenciaFarmaceutica.jpg',
                'valor' => 'https://coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara/',
                'tipo' => 'webview',
                'ordem' => 2,
                'options' => json_encode(['local_imagem' => 'app']),
            ],
            [
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'PERFIL',
                'tipo' => 'rota',
                'ordem' => 3,
                'options' => json_encode(
                    [
                        'local_imagem' => 'app',
                        'login' => true
                    ]
                ),
            ],
            [
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'LOGIN',
                'tipo' => 'rota',
                'ordem' => 3,
                'options' => json_encode(
                    [
                        'local_imagem' => 'app',
                        'login' => false
                    ]
                ),
            ],
        ]);
    }
}
