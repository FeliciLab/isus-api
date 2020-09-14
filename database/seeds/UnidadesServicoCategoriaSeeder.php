<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\UnidadesServicoCategoria;
use App\Model\UnidadeServico;

class UnidadesServicoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('unidades_servico_categoria')->insert(['categoria_id' => UnidadesServicoCategoria::WORDPRESS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE, 'unidade_servico_id' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);

        DB::table('unidades_servico_categoria')->insert(['categoria_id' => UnidadesServicoCategoria::WORDPRESS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO, 'unidade_servico_id' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);

        DB::table('unidades_servico_categoria')->insert([
        'categoria_id' => UnidadesServicoCategoria::WORDPRESS_CATEGORIA_APOIO_TECNICO,
        'unidade_servico_id' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);

        DB::table('unidades_servico_categoria')->insert(['categoria_id' => UnidadesServicoCategoria::WORDPRESS_CATEGORIA_ADMINISTRACAO_E_GESTAO, 'unidade_servico_id' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);

        DB::table('unidades_servico_categoria')->insert(['categoria_id' => UnidadesServicoCategoria::WORDPRESS_CATEGORIA_UTI, 'unidade_servico_id' => UnidadeServico::ISUS_CATEGORIA_UTI]);
    }
}
