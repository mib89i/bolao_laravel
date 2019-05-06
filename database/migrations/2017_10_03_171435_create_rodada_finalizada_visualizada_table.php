<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRodadaFinalizadaVisualizadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodada_finalizada_visualizada', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('rodada_finalizada_id')->unsigned();
            $table->foreign('rodada_finalizada_id')->references('id')->on('rodada_finalizada');
            
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');

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
        Schema::dropIfExists('rodada_finalizada_visualizada');
    }
}
