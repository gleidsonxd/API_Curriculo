<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioOportunidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_oportunidades', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned();
            $table->integer('op_id')->unsigned();
        });
        Schema::table('usuarios_oportunidades', function ($table) {
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('op_id')->references('id')->on('oportunidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('usuarios_oportunidades', function (Blueprint $table) {
            $table->dropIndex(['usuario_id']); // Drops index 'geo_state_index'
            $table->dropIndex(['op_id']); // Drops index 'geo_state_index'
        });
        Schema::dropIfExists('usuarios_oportunidades');
    }
}
