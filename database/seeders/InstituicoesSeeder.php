<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituicoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituicoes')->insert(['nome' => 'Hospital Leonardo da Vinci']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Geral Dr César Cals']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Geral de Fortaleza']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital de Messejana']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Regional Norte']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Regional do Sertão Central']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital São José']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Regional do Cariri']);
        DB::table('instituicoes')->insert(['nome' => 'Hospital Infantil Albert Sabin']);
    }
}
