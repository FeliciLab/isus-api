<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuizRespostas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'qquiz_respostas',
            function (Blueprint $table) {
                $table->id();

                $table->text('identificacao');
                $table->text('tipo_identificacao');
                $table->text('token')->nullable();

                $table->unsignedBigInteger('quiz_id');
                $table->foreign('quiz_id')->references('id')->on('qquiz_quiz');

                $table->unsignedBigInteger('questao_id');
                $table->foreign('questao_id')->references('id')->on('qquiz_questoes');

                $table->unsignedBigInteger('questao_alternativa_id');
                $table->foreign('questao_alternativa_id')->references('id')->on('qquiz_alternativas_questoes');

                $table->timestamps();
                $table->softDeletes();
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
        Schema::drop('qquiz_respostas');
    }
}
