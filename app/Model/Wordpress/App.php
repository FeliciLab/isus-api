<?php

namespace App\Model\Wordpress;

class App
{
    public const PREFIXO_CORONAVIRUS = 100;
    public const PREFIXO_SUS_ELMO = 200;

    public const WORDPRESS_ENDPOINT = [
        self::PREFIXO_CORONAVIRUS => 'https://coronavirus.ceara.gov.br/wp-json/wp/v2/',
        self::PREFIXO_SUS_ELMO => 'https://sus.ce.gov.br/elmo/wp-json/wp/v2/',
    ];

    private const APP = [
        self::PREFIXO_CORONAVIRUS => [
            'educacao' => [451, 452, 453, 454, 442],
            'pesquisaCientifica' => [443, 450, 448, 446, 445, 449],
            'minhaSaude' => [486, 487, 488],
            'boletinsEpidemiologicos' => [2],
        ],
        self::PREFIXO_SUS_ELMO => [
            'noticias' => [4],
        ],
    ];

    private const APP_V2_MAP = [
        'educacao' => 'Educação',
        'pesquisaCientifica' => 'Pesquisa Científica',
        'minhaSaude' => 'Minha Saúde',
        'boletinsEpidemiologicos' => 'Boletins Epidemiológicos',
        'noticias' => 'Notícias'
    ];

    public static function getApp($v2=null)
    {
        $appTemp = [];

        foreach (self::APP as $fonte => $categorias) {
            foreach ($categorias as $categoriaNome => $categoriasId) {
                $categoriasIdTemp = [];
                if ($fonte == self::PREFIXO_CORONAVIRUS) {
                    foreach ($categoriasId as $categoriaId) {
                        $categoriasIdTemp[] = self::PREFIXO_CORONAVIRUS . $categoriaId;
                    }
                } elseif ($fonte == self::PREFIXO_SUS_ELMO) {
                    foreach ($categoriasId as $categoriaId) {
                        $categoriasIdTemp[] = self::PREFIXO_SUS_ELMO . $categoriaId;
                    }
                }

                $chave = $v2 ? $categoriaNome : self::APP_V2_MAP[$categoriaNome];

                $appTemp[$chave] = $categoriasIdTemp;
            }
        }

        return $appTemp;
    }
}
