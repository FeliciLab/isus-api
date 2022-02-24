<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaguOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sagu_ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 60);
            $table->integer('carga_horaria');
            $table->boolean('is_active');
            $table->date('inicio');
            $table->date('fim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sagu_ofertas');
    }
}
