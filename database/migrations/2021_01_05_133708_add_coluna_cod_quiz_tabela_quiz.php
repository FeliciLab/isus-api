<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunaCodQuizTabelaQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'qquiz_quiz',
            function (Blueprint $table) {
                $table->string('cod_quiz')->unique();
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
        Schema::table(
            'qquiz_quiz',
            function (Blueprint $table) {
                $table->dropColumn('cod_quiz');
            }
        );
    }
}
