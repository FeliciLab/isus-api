<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdcBannerElmoSeeder extends Seeder
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
                'id' => 12,
                'ordem' => 10,
                'ativo' => true,
                'titulo' => 'Treinamentos Elmo',
                'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/12/Elmo-Banner-2.jpg',
                'valor' => 'https://sus.ce.gov.br/elmo/faca-seu-treinamento/',
                'tipo' => 'webview',
                'options' => json_encode(
                    [
                        'localImagem' => 'web',
                        'labelAnalytics' => 'banner_treinamento_elmo',
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
