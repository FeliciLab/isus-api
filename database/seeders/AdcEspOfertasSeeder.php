<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdcEspOfertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('esp_ofertas')->insert([
            [
                'id' => 1,
                'nome' => 'Oficina de Design de Serviços da ESP',
                'carga_horaria' => 6,
                'is_active' => true,
                'inicio' => '2022-06-28',
                'fim' => '2022-06-30',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
