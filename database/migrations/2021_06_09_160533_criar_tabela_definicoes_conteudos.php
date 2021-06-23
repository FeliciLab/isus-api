<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaDefinicoesConteudos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definicoes_conteudos', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_publico');
            $table->boolean('ativo');
            $table->string('categoria');
            $table->string('imagem');
            $table->unsignedInteger('ordem');
            $table->string('sessao');
            $table->string('tipo');
            $table->string('titulo');
            $table->string('valor');
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
        Schema::dropIfExists('definicoes_conteudos');
    }
}
