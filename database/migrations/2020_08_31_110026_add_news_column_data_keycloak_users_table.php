<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewsColumnDataKeycloakUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('municipio_id')->references('id')->on('municipios');
            $table->foreignId('categoriaprofissional_id')->nullable()->references('id')->on('categorias_profissionais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('municipio_id');
            $table->dropColumn('categoriaprofissional_id');
        });
    }
}
