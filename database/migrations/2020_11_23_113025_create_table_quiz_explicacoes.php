<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuizExplicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'qquiz_explicacoes',
            function (Blueprint $table) {
                $table->id();
                $table->text('descricao');

                $table->unsignedBigInteger('questao_id');
                $table->foreign('questao_id')
                    ->references('id')
                    ->on('qquiz_questoes');

                $table->unsignedBigInteger('alternativa_correta_id');
                $table->foreign('alternativa_correta_id')
                    ->references('id')
                    ->on('qquiz_alternativas_questoes');

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
        Schema::dropIfExists('qquiz_explicacoes');
    }
}
