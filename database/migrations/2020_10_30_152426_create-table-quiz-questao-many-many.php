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
            $table->unsignedBigInteger('quiz_id');
            $table->foreing('quiz_id')->references('qquiz_quiz')->on('id');

            $table->unsignedBigInteger('questao_id');
            $table->foreing('questao_id')->references('qquiz_questao')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
