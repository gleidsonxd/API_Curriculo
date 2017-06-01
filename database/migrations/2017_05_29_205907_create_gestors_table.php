<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
       Schema::table('oportunidades', function ($table) {
            $table->foreign('gestor_id')->references('id')->on('gestors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('oportunidades', function (Blueprint $table) {
            $table->dropIndex(['gestor_id']); // Drops index 'geo_state_index'
        });
        Schema::dropIfExists('gestors');
    }
}
