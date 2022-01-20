<?php

namespace Database\Seeders;

use App\Model\CategoriaProfissional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Acupuntura']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Alergia e Imunologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Anestesiologia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Angiologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cancerologia/cancerologia Clínica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cancerologia/cancerologia Cirúrgica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cancerologia/cancerologia Pediátrica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cardiologia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Cardiovascular']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia de Cabeça e Pescoço']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia do Aparelho Digestivo']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Geral']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Pediátrica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Plástica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Torácica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Cirurgia Vascular']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Clínica Médica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Coloproctologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Dermatologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Endocrinologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Endoscopia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Gastroenterologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Genética Médica']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Geriatria']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Ginecologia e Obstetrícia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Hematologia e Hemoterapia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Homeopatia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Infectologia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Mastologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina de Família e Comunidade']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina do Trabalho']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina do Tráfego']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Esportiva']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Física e Reabilitação']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Intensiva']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Legal']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Nuclear']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Medicina Preventiva e Social']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Nefrologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Neurocirurgia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Neurologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Nutrologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Oftalmologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Ortopedia e Traumatologia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Otorrinolaringologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Patologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Patologia Clínica/medicina Laboratorial']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Pediatria ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Pneumologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Psiquiatria']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Radiologia e Diagnóstico por Imagem']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Diagnóstico por Imagem: Atuação Exclusiva Ultra-sonografia Geral']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Diagnóstico por Imagem: Atuação Exclusiva Radiologia Intervencionista e Angiorradiologia']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Radioterapia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Reumatologia ']);
        DB::table('especialidades')->insert(['categoriaprofissional_id' => CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA, 'nome' => 'Urologia ']);

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
