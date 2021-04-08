<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoverNotnullTelefoneMunicipioUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->string('telefone')->nullable()->change();
                $table->unsignedBigInteger('municipio_id')
                    ->nullable()
                    ->change();
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
            'users',
            function (Blueprint $table) {
                $table->string('telefone')->nullable(false)->change();
                $table->unsignedBigInteger('municipio_id')
                    ->nullable(false)
                    ->change();
            }
        );
    }
}
