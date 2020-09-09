<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_projetos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->references('term_id')->on('categorias');
            $table->foreignId('projeto_id')->references('id')->on('projetos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_projetos');
    }
}
