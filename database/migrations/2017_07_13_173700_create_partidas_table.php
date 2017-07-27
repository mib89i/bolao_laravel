<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration {

    public function up() {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('data_partida');
            $table->timestamp('data_partida_final');
            $table->string('local');
            $table->integer('gols_time1');
            $table->integer('gols_time2');
            
            $table->integer('jogo_id');
            $table->foreign('jogo_id')->references('id')->on('jogos');
            
            $table->integer('time1_id');
            $table->foreign('time1_id')->references('id')->on('times');
            
            $table->integer('time2_id');
            $table->foreign('time2_id')->references('id')->on('times');
            
            $table->integer('importancia');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('partidas');
    }

}
