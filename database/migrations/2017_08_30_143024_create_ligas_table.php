<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            
            $table->string('nome');
            
            $table->integer('tipo_liga_id');
            $table->foreign('tipo_liga_id')->references('id')->on('tipo_liga');
            
            $table->integer('tipo_partida_id');
            $table->foreign('tipo_partida_id')->references('id')->on('tipo_partida');
            
            $table->boolean('publica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligas');
    }
}
