<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefinicoesConteudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $definicoes = [
            [
                'definicoes' => [
                    "id" => 1,
                    'id_publico' => 'elmo_treinamento',
                    "ordem" => 1,
                    "ativo" => true,
                    "titulo" => "Treinamento",
                    "imagem" => "SvgCapacitacao",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "tipo" => "webview",
                    "valor" => "https://sus.ce.gov.br/elmo/faca-sua-capacitacao/",
                ],
                'opcoes' => [
                    [
                        "definicoes_conteudos_id" => 1,
                        "chave" => "localImagem",
                        "valor" => "app",
                    ],
                    [
                        "definicoes_conteudos_id" => 1,
                        "chave" => "labelAnalytics",
                        "valor" => "elmo_card_treinamento"
                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 2,
                    'id_publico' => 'elmo_manual_uso',
                    "ordem" => 2,
                    "ativo" => true,
                    "titulo" => "Manual de Uso",
                    "imagem" => "SvgManualUso",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "https://sus.ce.gov.br/elmo/wp-content/uploads/sites/2/2021/01/Manual_Elmo_1.1_JAN2021.pdf",
                    "tipo" => "browser",
                ],
                'opcoes' => [
                    [
                        "definicoes_conteudos_id" => 2,
                        "chave" => "localImagem",
                        "valor" => "app"
                    ],
                    [
                        "definicoes_conteudos_id" => 2,
                        "chave" => "labelAnalytics",
                        "valor" => "elmo_card_manualdeuso"
                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 3,
                    'id_publico' => 'elmo_fale_conosco',
                    "ordem" => 3,
                    "ativo" => true,
                    "titulo" => "Fale Conosco",
                    "imagem" => "SvgFaleConosco",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "DUVIDAS_ELMO",
                    "tipo" => "rota",
                ],
                "opcoes" => [
                    [
                        "definicoes_conteudos_id" => 3,
                        "chave" => "localImagem",
                        "valor" => "app"
                    ],
                    [
                        "definicoes_conteudos_id" => 3,
                        'chave' => "labelAnalytics",
                        'valor' => "elmo_card_faleconosco"
                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 4,
                    'id_publico' => 'elmo_materiais',
                    "ordem" => 4,
                    "ativo" => true,
                    "titulo" => "Materiais",
                    "imagem" => "SvgFaleConosco",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "https://sus.ce.gov.br/elmo/materiais/",
                    "tipo" => "browser"
                ],
                "opcoes" => [
                    [
                        "definicoes_conteudos_id" => 4,
                        "chave" => "localImagem",
                        "valor" => "app",
                    ],
                    [
                        "definicoes_conteudos_id" => 4,
                        'chave' => "labelAnalytics",
                        'valor' => "elmo_card_materiais"
                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 5,
                    'id_publico' => 'elmo_depoimentos',
                    "ordem" => 5,
                    "ativo" => true,
                    "titulo" => "Depoimentos",
                    "imagem" => "SvgFaleConosco",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "https://sus.ce.gov.br/elmo/depoimentos/",
                    "tipo" => "browser",
                ],
                "opcoes" => [
                    [
                        "definicoes_conteudos_id" => 5,
                        'chave' => "localImagem",
                        'valor' => "app",
                    ],
                    [
                        "definicoes_conteudos_id" => 5,
                        'chave' => "labelAnalytics",
                        'valor' => "elmo_card_depoimentos",

                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 6,
                    'id_publico' => 'elmo_biblioteca',
                    "ordem" => 6,
                    "ativo" => true,
                    "titulo" => "Biblioteca",
                    "imagem" => "SvgFaleConosco",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "https://sus.ce.gov.br/elmo/biblioteca/",
                    "tipo" => "browser",
                ],
                "opcoes" => [
                    [
                        "definicoes_conteudos_id" => 6,
                        'chave' => "localImagem",
                        'valor' => "app",
                    ],
                    [
                        "definicoes_conteudos_id" => 6,
                        'chave' => "labelAnalytics",
                        'valor' => "elmo_card_biblioteca"
                    ]
                ]
            ],
            [
                'definicoes' => [
                    "id" => 7,
                    'id_publico' => 'elmo_doacoes',
                    "ordem" => 7,
                    "ativo" => true,
                    "titulo" => "Doações",
                    "imagem" => "SvgFaleConosco",
                    "categoria" => "elmo",
                    "sessao" => "conteudos",
                    "valor" => "https://sus.ce.gov.br/elmo/doacoes/",
                    "tipo" => "browser",
                ],
                "opcoes" => [
                    [
                        'definicoes_conteudos_id' => 7,
                        'chave' => "localImagem",
                        'valor' => "app",
                    ],
                    [
                        'definicoes_conteudos_id' => 7,
                        'chave' => "labelAnalytics",
                        'valor' => "elmo_card_doacoes",
                    ]
                ]
            ]
        ];

        DB::table('definicoes_conteudos')->insert(
            array_map(function ($item) {
                return $item['definicoes'];
            }, $definicoes)
        );

        DB::table('definicoes_conteudos_opcoes')->insert(
            array_reduce(
                array_map(function ($item) {
                    return $item['opcoes'];
                }, $definicoes),
                function ($carry, $item) {
                    if (!is_array($carry)) {
                        $carry = [];
                    }

                    foreach ($item as $value) {
                        $carry[] = $value;
                    }

                    return $carry;
                }
            )
        );
    }
};
