<?php

use Carbon\Carbon;
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
        DB::table('categorias_profissionais')->insert(
            [
                [
                    'id' => 1,
                    'nome' => 'Medicina',
                    'ordem' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 2,
                    'nome' => 'Fisioterapia',
                    'ordem' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 3,
                    'nome' => 'Enfermagem',
                    'ordem' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 4,
                    'nome' => 'Terapia Ocupacional',
                    'ordem' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 5,
                    'nome' => 'Farmácia',
                    'ordem' => 5,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 6,
                    'nome' => 'Coordenação Clínica',
                    'ordem' => 6,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 7,
                    'nome' => 'Coordenação de Enfermagem',
                    'ordem' => 7,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 8,
                    'nome' => 'Outra',
                    'ordem' => 99,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 9,
                    'nome' => 'Agente Comunitário de Saúde',
                    'ordem' => 8,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 10,
                    'nome' => 'Agente Comunitário de Endemias',
                    'ordem' => 9,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 11,
                    'nome' => 'Técnico em Enfermagem',
                    'ordem' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 12,
                    'nome' => 'Técnico em Radiologia',
                    'ordem' => 11,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 13,
                    'nome' => 'Técnico em Saúde Bucal',
                    'ordem' => 12,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 14,
                    'nome' => 'Auxiliar de Enfermagem',
                    'ordem' => 13,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 15,
                    'nome' => 'Doula',
                    'ordem' => 14,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 16,
                    'nome' => 'Fonoaudiologia',
                    'ordem' => 15,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 17,
                    'nome' => 'Psicologia',
                    'ordem' => 16,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 18,
                    'nome' => 'Serviço Social',
                    'ordem' => 17,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 19,
                    'nome' => 'Educação Física',
                    'ordem' => 18,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 20,
                    'nome' => 'Nutrição',
                    'ordem' => 19,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 21,
                    'nome' => 'Odontologia',
                    'ordem' => 20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 22,
                    'nome' => 'Biomedicina',
                    'ordem' => 21,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
