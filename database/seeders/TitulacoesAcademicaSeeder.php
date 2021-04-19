<?php
namespace Database\Seeders;

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
        DB::table('titulacoes_academica')->insert(['id'   => 1 ,'nome' => 'Graduado']);
        DB::table('titulacoes_academica')->insert(['id'   => 2 ,'nome' => 'Especialista']);
        DB::table('titulacoes_academica')->insert(['id'   => 3 ,'nome' => 'Mestrado']);
        DB::table('titulacoes_academica')->insert(['id'   => 4 ,'nome' => 'Doutorado']);
        DB::table('titulacoes_academica')->insert(['id'   => 5 ,'nome' => 'Residência em Terapia Intensiva']);
        DB::table('titulacoes_academica')->insert(['id'   => 6 ,'nome' => 'Residência em Clínica Médica']);
        DB::table('titulacoes_academica')->insert(['id'   => 7 ,'nome' => 'Residência em Urgência e Emergência']);
        DB::table('titulacoes_academica')->insert(['id'   => 8 ,'nome' => 'Residência em Anestesiologia']);
        DB::table('titulacoes_academica')->insert(['id'   => 9 ,'nome' => 'Residência em Outra']);
    }
}
