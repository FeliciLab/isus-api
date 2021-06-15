<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarDefinicoesConteudoOpcoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definicoes_conteudos_opcoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('definicoes_conteudos_id');
            $table->foreign('definicoes_conteudos_id')->references('id')->on('definicoes_conteudos');
            $table->string('chave');
            $table->text('valor');
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
        Schema::dropDatabaseIfExists('definicoes_conteudos_opcoes');
    }
}
