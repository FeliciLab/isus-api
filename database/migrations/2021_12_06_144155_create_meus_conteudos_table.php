<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeusConteudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meus_conteudos', function (Blueprint $table) {
            $table->id();
            $table->string('imagem');
            $table->string('title', 255);
            $table->text('link');
            $table->string('data', 60);
            $table->boolean('ativo');
            $table->string('tipo_conteudo');
            $table->foreignId('categoriaprofissional_id')->references('id')->on('categorias_profissionais');
            $table->foreignId('especialidade_id')->nullable()->references('id')->on('especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meus_conteudos');
    }
}
