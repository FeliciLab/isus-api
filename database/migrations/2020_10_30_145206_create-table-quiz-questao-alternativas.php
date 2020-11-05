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
        Schema::create('qquiz_alternativas_questoes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ordem');
            $table->text('alternativa');
            $table->text('url_imagem');
            $table->unsignedInteger('pontuacao');

            $table->unsignedBigInteger('questao_id');
            $table->foreign('questao_id')->references('id')->on('qquiz_questoes');

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
        Schema::drop('qquiz_alternativas_questoes');
    }
}
