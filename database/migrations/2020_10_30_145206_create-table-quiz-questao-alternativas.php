<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuizQuestaoAlternativas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qquiz_questoes_alternativas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ordem_alternativa');
            $table->text('alternativa');
            $table->text('url_imagem');
            $table->unsignedInteger('pontuacao');
            $table->unsignedBigInteger('questao_id');
            $table->foreing('questao_id')->references('qquiz_questoes')->on('id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qquiz_questoes_alternativas');
    }
}
