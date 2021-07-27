<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunaAtivoQuiz extends Migration
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
                $table->boolean('ativo')->default(false);
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
                $table->dropColumn('ativo');
            }
        );
    }
}
