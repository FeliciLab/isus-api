<?php

namespace App\Model\Wordpress;

class App
{
    public const PREFIXO_CORONAVIRUS = 100;
    public const PREFIXO_SUS = 200;

    public const WORDPRESS_ENDPOINT = [
        self::PREFIXO_CORONAVIRUS => 'https://coronavirus.ceara.gov.br/wp-json/wp/v2/',
        self::PREFIXO_SUS => 'https://sus.ce.gov.br/elmo/wp-json/wp/v2/',
    ];

    public $apps = [
        self::PREFIXO_CORONAVIRUS => [
            'Educação' => [451, 452, 453, 454, 442],
            'Pesquisa Científica' => [443, 450, 448, 446, 445, 449],
            'Minha Saúde' => [486, 487, 488],
            'Boletins Epidemiológicos' => [2],
        ],
        self::PREFIXO_SUS => [
            'Notícias' => [4],
            'Biblioteca' => [13],
            'Instruções' => [40],
        ],
    ];

    public function getApp()
    {
        $appTemp = [];

        foreach ($this->apps as $fonte => $categorias) {
            foreach ($categorias as $categoriaNome => $categoriasId) {
                $categoriasIdTemp = [];
                if ($fonte == self::PREFIXO_CORONAVIRUS) {
                    foreach ($categoriasId as $categoriaId) {
                        $categoriasIdTemp[] = self::PREFIXO_CORONAVIRUS . $categoriaId;
                    }
                } elseif ($fonte == self::PREFIXO_SUS) {
                    foreach ($categoriasId as $categoriaId) {
                        $categoriasIdTemp[] = self::PREFIXO_SUS . $categoriaId;
                    }
                }

                $appTemp[$categoriaNome] = $categoriasIdTemp;
            }
        }

        return $appTemp;
    }
}
