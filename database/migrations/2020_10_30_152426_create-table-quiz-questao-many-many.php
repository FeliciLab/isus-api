<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuizQuestaoManyMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qquiz_quiz_questoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->foreign('quiz_id')->references('id')->on('qquiz_quiz');

            $table->unsignedBigInteger('questao_id');
            $table->foreign('questao_id')->references('id')->on('qquiz_questoes');
            $table->unsignedTinyInteger('ordem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qquiz_quiz_questoes');
    }
}
