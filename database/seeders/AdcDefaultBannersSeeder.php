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
                'ordem' => 8,
                'ativo' => false,
                'titulo' => 'Guia de Assistência Farmacêutica',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/11/guia-de-assistencia-farmaceutica-thumb-isus.jpg',
                'valor' => 'https://coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara/',
                'tipo' => 'webview',
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
                'ordem' => 6,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'PERFIL',
                'tipo' => 'rota',
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
                'ordem' => 6,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'LOGIN',
                'tipo' => 'rota',
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
                'ordem' => 1,
                'ativo' => false,
                'titulo' => 'SUS 30 anos',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2020/09/SUS-30-anos.png',
                'valor' => 'https://www.esp.ce.gov.br/tag/semana-do-sus/',
                'tipo' => 'webview',
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
                'ordem' => 3,
                'ativo' => true,
                'titulo' => 'Regulação de Pacientes',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/BANNER-ISUS.png',
                'valor' => 'https://coronavirus.ceara.gov.br/project/nota-informativa-orienta-sobre-os-procedimentos-de-regulacao-de-pacientes-com-sindrome-gripal-sindrome-respiratoria-aguda-grave/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_regulacao_pacientes',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'ordem' => 3,
                'ativo' => false,
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
                'ordem' => 5,
                'ativo' => true,
                'titulo' => 'Manejo Clínico',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/unnamed.png',
                'valor' => 'https://coronavirus.ceara.gov.br/profissional/manejoclinico/',
                'tipo' => 'webview',
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
                'ativo' => false,
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
                'ativo' => false,
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
            [
                'id' => 12,
                'ordem' => 10,
                'ativo' => false,
                'titulo' => 'Treinamentos Elmo',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/unnamed-3.png',
                'valor' => 'https://sus.ce.gov.br/elmo/faca-seu-treinamento/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_treinamento_elmo'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 13,
                'ordem' => 5,
                'ativo' => false,
                'titulo' => 'Nota Técnica ESP/SESA',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/unnamed-1.png',
                'valor' => 'https://coronavirus.ceara.gov.br/project/nt-esp-sesa-01-2021-orientacoes-sore-uso-de-oseltamivir-para-tratamento-de-influenza/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'notaTecnica_esp_sesa'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 14,
                'ordem' => 2,
                'ativo' => true,
                'titulo' => 'Protocolos e Fluxogramas',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/unnamed-2.png',
                'valor' => 'https://coronavirus.ceara.gov.br/project/esp-ce-desenvolve-fluxograma-para-orientar-sobre-atendimento-inicial-a-pacientes-com-sindrome-gripal/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_fluxograma'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 15,
                'ordem' => 4,
                'ativo' => true,
                'titulo' => 'Painel Covid-19',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/01/Cisec-1.png',
                'valor' => 'https://cisec.esp.ce.gov.br/#',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'painel_alerta_covid_19'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 16,
                'ordem' => 99,
                'ativo' => false,
                'titulo' => 'Matrícula Residência',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2022/02/Matricula-Resmed-banner-isus.png',
                'valor' => 'https://www.esp.ce.gov.br/ensino/residencia-em-saude/matricula/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_matricula_residencias'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 17,
                'ordem' => 1,
                'ativo' => true,
                'titulo' => 'Programa PBM',
                'imagem' => 'https://www.esp.ce.gov.br/wp-content/uploads/sites/78/2022/04/Slider-PBM.png',
                'valor' => 'https://pbmipheduca.eduvem.com/#',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_programa_PBM'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
