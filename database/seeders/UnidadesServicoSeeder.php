<?php

namespace Database\Seeders;

use App\Model\UnidadeServico;
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
        DB::table('unidades_servico')->insert(['id' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE, 'nome' => 'Assistência direta ao paciente']);
        DB::table('unidades_servico')->insert(['id' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO, 'nome' => 'Apoio diagnóstico ou terapêutico']);
        DB::table('unidades_servico')->insert(['id' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO, 'nome' => 'Apoio técnico']);
        DB::table('unidades_servico')->insert(['id' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO, 'nome' => 'Administração e gestão']);

        DB::table('unidades_servico')->insert(['nome' => 'Pronto-socorro', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'Ambulatório', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'Centro cirúrgico', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'Centro obstétrico', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'Internação', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'UTI', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de assistência direta ao paciente', 'pai' => UnidadeServico::ISUS_CATEGORIA_ASSISTENCIA_DIRETA_AO_PACIENTE]);

        DB::table('unidades_servico')->insert(['nome' => 'Laboratório clínico', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Diagnóstico por imagem', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Hemodinâmica ou cardiologia intervencionista', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Nefrologia ou terapia renal substitutiva', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio diagnóstico e terapêutico', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_DIAGNOSTICO_OU_TERAPEUTICO]);

        DB::table('unidades_servico')->insert(['nome' => 'Triagem e acolhimento', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Acolhimento psicossocial', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Alimentação e assistência nutricional e dietética', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Farmácia e assistência farmacêutica', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Fisioterapia fonoaudiologia e terapia ocupacional', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Esterilização de materiais', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Arquivo médico e estatística', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Epidemiologia vigilância epidemiológica e registro de óbito', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio técnico', 'pai' => UnidadeServico::ISUS_CATEGORIA_APOIO_TECNICO]);

        DB::table('unidades_servico')->insert(['nome' => 'Gestão estratégica', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Regulação contas hospitalares e gestão de riscos', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Gestão de pessoas', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Formação ou qualificação profissional', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Estágio profissional', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Residência médica ou multiprofissional', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Saúde e segurança do trabalho', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Apoio administrativo', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Higiene e limpeza', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Transporte e segurança', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Materiais e suprimentos', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Manutenção e reparos', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
        DB::table('unidades_servico')->insert(['nome' => 'Outro setor ou serviço de apoio administrativo', 'pai' => UnidadeServico::ISUS_CATEGORIA_ADMINISTRACAO_E_GESTAO]);
    }
}
