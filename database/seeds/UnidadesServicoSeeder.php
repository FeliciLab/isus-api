<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('unidades_servico')->insert(['id' => 1, 'nome' => 'Assistência direta ao paciente']);
        DB::table('unidades_servico')->insert(['id' => 2, 'nome' => 'Apoio diagnóstico ou terapêutico']);
        DB::table('unidades_servico')->insert(['id' => 3, 'nome' => 'Apoio técnico']);
        DB::table('unidades_servico')->insert(['id' => 4, 'nome' => 'Administração e gestão']);

        DB::table('unidades_servico')->insert(['nome' => 'Pronto-socorro', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'Ambulatório', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'Centro cirúrgico', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'Centro obstétrico', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'Internação', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'UTI', 'pai' => 1]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de assistência direta ao paciente', 'pai' => 1]);


        DB::table('unidades_servico')->insert(['nome' => 'Laboratório clínico', 'pai' => 2]);
        DB::table('unidades_servico')->insert(['nome' => 'Diagnóstico por imagem', 'pai' => 2]);
        DB::table('unidades_servico')->insert(['nome' => 'Hemodinâmica ou cardiologia intervencionista', 'pai' => 2]);
        DB::table('unidades_servico')->insert(['nome' => 'Nefrologia ou terapia renal substitutiva', 'pai' => 2]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio diagnóstico e terapêutico', 'pai' => 2]);


        DB::table('unidades_servico')->insert(['nome' => 'Triagem e acolhimento', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Acolhimento psicossocial', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Alimentação e assistência nutricional e dietética', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Farmácia e assistência farmacêutica', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Fisioterapia fonoaudiologia e terapia ocupacional', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Esterilização de materiais', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Arquivo médico e estatística', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Epidemiologia vigilância epidemiológica e registro de óbito', 'pai' => 3]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio técnico', 'pai' => 3]);



        DB::table('unidades_servico')->insert(['nome' => 'Gestão estratégica', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Regulação contas hospitalares e gestão de riscos', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Gestão de pessoas', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Formação ou qualificação profissional', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Estágio profissional', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Residência médica ou multiprofissional', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Saúde e segurança do trabalho', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Apoio administrativo', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Higiene e limpeza', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Transporte e segurança', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Materiais e suprimentos', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Manutenção e reparos', 'pai' => 4]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio administrativo', 'pai' => 4]);
    }
}
