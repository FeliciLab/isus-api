<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'qquiz_quiz',
            function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->string('area_tematica')->nullable();
                $table->string('publico_alvo')->nullable();
                $table->text('descricao')->nullable();
                $table->unsignedInteger('tempo_limite')->default(10);
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
        Schema::drop('qquiz_quiz');
    }
}
