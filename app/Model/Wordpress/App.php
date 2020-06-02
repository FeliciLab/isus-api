<?php

namespace App\Model\Wordpress;

class App
{
    const WORDPRESS_ENDPOINT = 'https://coronavirus.ceara.gov.br/wp-json/wp/v2/';

    const APP = [
        'Educação' => [451, 452, 453, 454, 442],
        'Pesquisa Científica' => [443, 450, 448, 446, 445, 449],
        'Minha Saúde' => [486, 487, 488],
        'Boletins Epidemiológicos' => [2]
    ];
}
