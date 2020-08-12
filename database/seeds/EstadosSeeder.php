<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(['id'   => 1 ,'nome' => 'Acre', 'uf' => 'AC']);
        DB::table('estados')->insert(['id'   => 2 ,'nome' => 'Alagoas', 'uf' => 'AL']);
        DB::table('estados')->insert(['id'   => 3 ,'nome' => 'Amazonas', 'uf' => 'AM']);
        DB::table('estados')->insert(['id'   => 4 ,'nome' => 'Amapá', 'uf' => 'AP']);
        DB::table('estados')->insert(['id'   => 5 ,'nome' => 'Bahia', 'uf' => 'BA']);
        DB::table('estados')->insert(['id'   => 6 ,'nome' => 'Ceará', 'uf' => 'CE']);
        DB::table('estados')->insert(['id'   => 7 ,'nome' => 'Distrito Federal', 'uf' => 'DF']);
        DB::table('estados')->insert(['id'   => 8 ,'nome' => 'Espírito Santo', 'uf' => 'ES']);
        DB::table('estados')->insert(['id'   => 9 ,'nome' => 'Goiás', 'uf' => 'GO']);
        DB::table('estados')->insert(['id'   => 10, 'nome' => 'Maranhão', 'uf' => 'MA']);
        DB::table('estados')->insert(['id'   => 11, 'nome' => 'Minas Gerais', 'uf' => 'MG']);
        DB::table('estados')->insert(['id'   => 12, 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS']);
        DB::table('estados')->insert(['id'   => 13, 'nome' => 'Mato Grosso', 'uf' => 'MT']);
        DB::table('estados')->insert(['id'   => 14, 'nome' => 'Pará', 'uf' => 'PA']);
        DB::table('estados')->insert(['id'   => 15, 'nome' => 'Paraíba', 'uf' => 'PB']);
        DB::table('estados')->insert(['id'   => 16, 'nome' => 'Pernambuco', 'uf' => 'PE']);
        DB::table('estados')->insert(['id'   => 17, 'nome' => 'Piauí', 'uf' => 'PI']);
        DB::table('estados')->insert(['id'   => 18, 'nome' => 'Paraná', 'uf' => 'PR']);
        DB::table('estados')->insert(['id'   => 19, 'nome' => 'Rio de Janeiro', 'uf' => 'RJ']);
        DB::table('estados')->insert(['id'   => 20, 'nome' => 'Rio Grande do Norte', 'uf' => 'RN']);
        DB::table('estados')->insert(['id'   => 21, 'nome' => 'Rondônia', 'uf' => 'RO']);
        DB::table('estados')->insert(['id'   => 22, 'nome' => 'Roraima', 'uf' => 'RR']);
        DB::table('estados')->insert(['id'   => 23, 'nome' => 'Rio Grande do Sul', 'uf' => 'RA']);
        DB::table('estados')->insert(['id'   => 24, 'nome' => 'Santa Catarina', 'uf' => 'SC']);
        DB::table('estados')->insert(['id'   => 25, 'nome' => 'Sergipe', 'uf' => 'SE']);
        DB::table('estados')->insert(['id'   => 26, 'nome' => 'São Paulo', 'uf' => 'SP']);
        DB::table('estados')->insert(['id'   => 27, 'nome' => 'Tocantins', 'uf' => 'TO']);
    }
}
