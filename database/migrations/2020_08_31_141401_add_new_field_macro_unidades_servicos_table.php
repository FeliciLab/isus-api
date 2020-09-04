<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldMacroUnidadesServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades_servico', function (Blueprint $table) {
            $table->foreignId('pai')->nullable()->after('id')->references('id')->on('unidades_servico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidades_servico', function (Blueprint $table) {
            $table->dropColumn('pai');
        });
    }
}
