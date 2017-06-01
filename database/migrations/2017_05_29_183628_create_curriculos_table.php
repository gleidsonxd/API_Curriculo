<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('lattes');
            $table->string('linkedin');
            $table->string('cur_job');
            $table->longText('exp_prof');
            $table->longText('skill');
            $table->string('archive');
            $table->timestamps();
        });
        Schema::table('curriculos', function ($table) {
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('curriculos', function (Blueprint $table) {
            $table->dropIndex(['usuario_id']); // Drops index 'geo_state_index'
        });
        Schema::dropIfExists('curriculos');
        
    }
}
