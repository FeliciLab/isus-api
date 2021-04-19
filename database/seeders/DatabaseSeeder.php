<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadosSeeder::class,
            MunicipiosSeeder::class,
            CategoriasProfissionaisSeeder::class,
            TipoContratacoesSeeder::class,
            TitulacoesAcademicaSeeder::class,
            InstituicoesSeeder::class,
            UnidadesServicoSeeder::class,
            UnidadesServicoCategoriaSeeder::class,
            EspecialidadesSeeder::class,
            AvaliacaoDigitalDaForcaDeTrabalhoEmSaudePt1::class,
            AdcDefaultBannersSeeder::class
        ]);
    }
}
