<?php

use App\Model\CategoriaProfissional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\UnidadeServico;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ACUPUNTURA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ALERGIA E IMUNOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ANESTESIOLOGIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ANGIOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CANCEROLOGIA/CANCEROLOGIA CLÍNICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CANCEROLOGIA/CANCEROLOGIA CIRÚRGICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CANCEROLOGIA/CANCEROLOGIA PEDIÁTRICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CARDIOLOGIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA CARDIOVASCULAR']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA DE CABEÇA E PESCOÇO']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA DO APARELHO DIGESTIVO']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA GERAL']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA PEDIÁTRICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA PLÁSTICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA TORÁCICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CIRURGIA VASCULAR']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'CLÍNICA MÉDICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'COLOPROCTOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'DERMATOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ENDOCRINOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ENDOSCOPIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'GASTROENTEROLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'GENÉTICA MÉDICA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'GERIATRIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'GINECOLOGIA E OBSTETRÍCIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'HEMATOLOGIA E HEMOTERAPIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'HOMEOPATIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'INFECTOLOGIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MASTOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA DE FAMÍLIA E COMUNIDADE']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA DO TRABALHO']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA DO TRÁFEGO']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA ESPORTIVA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA FÍSICA E REABILITAÇÃO']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA INTENSIVA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA LEGAL']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA NUCLEAR']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'MEDICINA PREVENTIVA E SOCIAL']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'NEFROLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'NEUROCIRURGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'NEUROLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'NUTROLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'OFTALMOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'ORTOPEDIA E TRAUMATOLOGIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'OTORRINOLARINGOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'PATOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'PATOLOGIA CLÍNICA/MEDICINA LABORATORIAL']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'PEDIATRIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'PNEUMOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'PSIQUIATRIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'RADIOLOGIA E DIAGNÓSTICO POR IMAGEM']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'DIAGNÓSTICO POR IMAGEM: ATUAÇÃO EXCLUSIVA ULTRA-SONOGRAFIA GERAL']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'DIAGNÓSTICO POR IMAGEM: ATUAÇÃO EXCLUSIVA RADIOLOGIA INTERVENCIONISTA E ANGIORRADIOLOGIA']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'RADIOTERAPIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'REUMATOLOGIA ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'UROLOGIA']);

        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Aeroespacial']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Aquaviária']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Acesso Vascular e Terapia Infusional']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Assistência de Enfermagem em Anestesiologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Assistência Domiciliária']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Captação, Doação e Transplante de Órgãos e Tecidos']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Cardiologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Central de Material e Esterilização']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Centro Cirúrgico']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Cuidados Paliativos']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Dermatológica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Diagnóstico por Imagens']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Doenças Infecciosas e Parasitárias']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Endocrinologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Estética']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Estomaterapia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Farmacologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Forense']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Genética e Genâmica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Hematologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Hemoterapia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Hiperbárica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem no Manejo da Dor']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Nefrologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Neurologia e Neurocirurgia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem Offshore']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Oftalmologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Oncologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Otorrinolaringologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Práticas Integrativas e Complementares']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Prevenção e Controle de Infecção Hospitalar']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde da Criança e Adolescente']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde Coletiva']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde da Mulher']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde do Adulto']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde do Homem']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde do Idoso']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde do Trabalhador ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde Indígena']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Saúde Mental ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Sexologia Humana']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Sistematização da Assistência da Enfermagem-SAE']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Terapia Intensiva']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Terapia Nutricional e Nutrição Clínica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Traumato-ortopedia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Urgência e Emergência']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Urologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Vigilância']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Direito Sanitário']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Economia da Saúde']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Auditoria']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Gerenciamento 1 Gestão']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Informática em Saúde']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Políticas Públicas']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Bioética']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Educação em Enfermagem']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Educação Permanente e Continuada em Saúde']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Enfermagem em Pesquisa Clínica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_ENFERMAGEM, 'nome' => 'Ética']);
    }
}
