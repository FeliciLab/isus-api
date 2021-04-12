<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdcOrdemCategoriaProfissional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'categorias_profissionais',
            function (Blueprint $table) {
                $table->string('ordem');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'categorias_profissionais',
            function (Blueprint $table) {
                $table->dropColumn('ordem');
            }
        );
    }
}
