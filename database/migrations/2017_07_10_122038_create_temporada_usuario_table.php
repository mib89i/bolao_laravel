<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporadaUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporada_usuario', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('temporada_id');
            $table->foreign('temporada_id')->references('id')->on('temporadas');
            
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            
            $table->boolean('aceito');
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
        Schema::dropIfExists('temporada_usuario');
    }
}
