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
                'id' => 1,
                'ativo' => false,
                'ordem' => 99,
                'titulo' => 'Vacinação',
                'imagem' => 'images/banners/vacinaCovid19.png',
                'valor' => 'https://coronavirus.ceara.gov.br/vacina',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'app',
                        'labelAnalytics' => 'banner_vacina_covid19',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'ativo' => false,
                'titulo' => 'Guia de Assistência Farmacêutica',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/11/guia-de-assistencia-farmaceutica-thumb-isus.jpg',
                'valor' => 'https://coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara/',
                'tipo' => 'webview',
                'ordem' => 8,
                'options' => json_encode(
                    [
                        'localImagem' => 'app',
                        'labelAnalytics' => 'guia_assistencia_farmaceutica',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'PERFIL',
                'tipo' => 'rota',
                'ordem' => 5,
                'options' => json_encode(
                    [
                        'localImagem' => 'app',
                        'login' => true,
                        'labelAnalytics' => 'id_saude',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'LOGIN',
                'tipo' => 'rota',
                'ordem' => 5,
                'options' => json_encode(
                    [
                        'localImagem' => 'app',
                        'login' => false,
                        'labelAnalytics' => 'id_saude',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'ativo' => false,
                'titulo' => 'SUS 30 anos',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/09/SUS-30-anos.png',
                'valor' => 'https://www.esp.ce.gov.br/tag/semana-do-sus/',
                'tipo' => 'webview',
                'ordem' => 1,
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'sus_30_anos',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'ativo' => false,
                'titulo' => 'PPSUS',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/09/PPSUS.png',
                'valor' => 'https://www.esp.ce.gov.br/tag/ppsus/',
                'tipo' => 'webview',
                'ordem' => 2,
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_ppsus',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ativo' => true,
                'id' => 7,
                'ordem' => 3,
                'titulo' => 'Cartilha de Saúde Mental',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/09/Banner-Cartilha-Saúde-Mental.png',
                'valor' => 'https://coronavirus.ceara.gov.br/cartilhas-sobre-saude-mental/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_cartilha_saude_mental',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'ativo' => true,
                'titulo' => 'Manejo Clínico',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/09/Banner-Cartilha-Saúde-Mental.png',
                'valor' => 'https://coronavirus.ceara.gov.br/profissional/manejoclinico/',
                'tipo' => 'webview',
                'ordem' => 4,
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_manejo_clinico',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'ordem' => 6,
                'ativo' => false,
                'titulo' => 'Covid-19 Heroes Study',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/10/Covid-Heroes-iSUS.png',
                'valor' => 'https://heroescovid19study.org/survey/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'bannercovid19heroesstudy',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'ordem' => 7,
                'ativo' => true,
                'titulo' => 'Protocolo do primeiro atendimento ao paciente com síndrome coronariana aguda',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/11/Protocolo-Sindroma-Coroniana-Aguda.png',
                'valor' => 'https://coronavirus.ceara.gov.br/project/protocolo-da-sesa-orienta-atendimentos-a-pacientes-com-sindrome-coronariana-aguda/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'bannerprotocolocoronariana',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 11,
                'ordem' => 9,
                'ativo' => true,
                'titulo' => 'ObservaEPS - Comunidade de práticas',
                'imagem' => 'http://www.esp.ce.gov.br/wp-content/uploads/sites/78/2021/06/Slider-CdP-Observa-III.png',
                'valor' => 'tinyurl.com/CPobservaEPS',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_observaeps',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
