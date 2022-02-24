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
                'nome' => 'Imersão 01',
                'carga_horaria' => 100,
                'is_active' => true,
                'inicio' => Carbon::now(),
                'fim' => Carbon::now()->add(10, 'day'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nome' => 'Imersão 02',
                'carga_horaria' => 100,
                'is_active' => true,
                'inicio' => Carbon::now(),
                'fim' => Carbon::now()->add(10, 'day'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'nome' => 'Imersão 03',
                'carga_horaria' => 100,
                'is_active' => false,
                'inicio' => Carbon::now(),
                'fim' => Carbon::now()->add(10, 'day'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
