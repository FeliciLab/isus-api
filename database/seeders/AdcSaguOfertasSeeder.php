<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdcSaguOfertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sagu_ofertas')->insert([
            [
                'id' => 1,
                'nome' => 'IMERSÃO TURMA 09',
                'carga_horaria' => 120,
                'is_active' => true,
                'inicio' => '2022-03-07',
                'fim' => '2022-03-18',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
