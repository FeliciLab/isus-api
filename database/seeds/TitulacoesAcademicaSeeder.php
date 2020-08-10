<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitulacoesAcademicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titulacoes_academica')->insert(['id'   => 1 ,'nome' => 'Titulação 1']);
        DB::table('titulacoes_academica')->insert(['id'   => 2 ,'nome' => 'Titulação 2']);
    }
}
