<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContratacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_contratacoes')->insert(['id'   => 1, 'nome' => 'Estatutário']);
        DB::table('tipo_contratacoes')->insert(['id'   => 2, 'nome' => 'Cooperado']);
        DB::table('tipo_contratacoes')->insert(['id'   => 3, 'nome' => 'Terceirizado']);
        DB::table('tipo_contratacoes')->insert(['id'   => 4, 'nome' => 'Autônomo']);
        DB::table('tipo_contratacoes')->insert(['id'   => 5, 'nome' => 'Outro']);
    }
}
