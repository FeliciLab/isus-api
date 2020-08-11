<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasProfissionaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias_profissionais')->insert(['id'   => 1 ,'nome' => 'Medicina']);
        DB::table('categorias_profissionais')->insert(['id'   => 2 ,'nome' => 'Fisioterapia']);
        DB::table('categorias_profissionais')->insert(['id'   => 3 ,'nome' => 'Enfermagem']);
        DB::table('categorias_profissionais')->insert(['id'   => 4 ,'nome' => 'Terapia Ocupacional']);
        DB::table('categorias_profissionais')->insert(['id'   => 5 ,'nome' => 'Farmácia']);
        DB::table('categorias_profissionais')->insert(['id'   => 6 ,'nome' => 'Coordenação Clínica']);
        DB::table('categorias_profissionais')->insert(['id'   => 7 ,'nome' => 'Coordenação de Enfermagem']);
        DB::table('categorias_profissionais')->insert(['id'   => 8 ,'nome' => 'Outra']);
    }
}
