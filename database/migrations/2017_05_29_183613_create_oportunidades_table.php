<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOportunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gestor_id')->unsigned();
            $table->string('cod');
            $table->string('type');
            $table->dateTime('ini_date');
            $table->dateTime('fin_date');
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
        Schema::table('oportunidades', function (Blueprint $table) {
            $table->dropIndex(['gestor_id']); // Drops index 'geo_state_index'
        });
        Schema::dropIfExists('oportunidades');
    }
}
