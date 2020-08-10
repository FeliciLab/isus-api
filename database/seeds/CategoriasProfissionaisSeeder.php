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
        DB::table('categorias_profissionais')->insert(['id'   => 1 ,'nome' => 'Categoria 1']);
        DB::table('categorias_profissionais')->insert(['id'   => 2 ,'nome' => 'Categoria 2']);
    }
}
