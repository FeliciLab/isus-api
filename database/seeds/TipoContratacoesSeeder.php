<?php

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
        DB::table('tipo_contratacoes')->insert(['id'   => 1 ,'nome' => 'Contratação 1']);
        DB::table('tipo_contratacoes')->insert(['id'   => 2 ,'nome' => 'Contratação 2']);
    }
}
