<?php
namespace Database\Seeders;
use App\Model\CategoriaProfissional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\UnidadeServico;

class MeusConteudosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('meus_conteudos')->insert(
            ['id' => 1,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Relação Estadual de Medicamentos do Ceará – RESME/CE 2021',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 5
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 2,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Fisioterapia',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 2
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 3,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Tecnico Radiologia',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 12
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 4,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Medicina - Cardiologia',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 1,
            'especialidade_id' => 8
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 5,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Medicina - Cirurgia Geral',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 1,
            'especialidade_id' => 12
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 6,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Enfermagem - Demartologica',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 3,
            'especialidade_id' => 67
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 7,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Enfermagem - Estetica',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 3,
            'especialidade_id' => 71
        ]);
        DB::table('meus_conteudos')->insert(
            ['id' => 8,
            'imagem' => 'https://coronavirus.ceara.gov.br/wp-content/uploads/2021/04/resme.png',
            'title' => 'Medicina - Cardiologia - conteudo 2',
            'link' => 'https://coronavirus.ceara.gov.br/project/relacao-estadual-de-medicamentos-do-ceara-resme-ce-2021/',
            'data' => '2021-08-30 14:15:10',
            'ativo' => true,
            'tipo_conteudo' => 'webview',
            'categoriaprofissional_id' => 1,
            'especialidade_id' => 8
        ]);

    }
}
