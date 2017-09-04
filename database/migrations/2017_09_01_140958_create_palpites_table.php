<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalpitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palpites', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('placar_time1');
            
            $table->integer('placar_time2');
            
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            
            $table->integer('jogo_id');
            $table->foreign('jogo_id')->references('id')->on('jogos');
            
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
        Schema::dropIfExists('palpites');
    }
}