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
        Schema::create('qquiz_respostas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_id');
            $table->foreing('quiz_id')->references('qquiz_quiz')->on('id');

            $table->unsignedBigInteger('questao_id');
            $table->foreing('questao_id')->references('qquiz_questao')->on('id');

            $table->unsignedBigInteger('questao_alternativa_id');
            $table->foreing('questao_alternativa_id')->references('qquiz_questao_alternativa')->on('id');

            $table->text('identificacao');
            $table->text('tipo_identificacao');

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
        Schema::drop('qquiz_respostas');
    }
}
