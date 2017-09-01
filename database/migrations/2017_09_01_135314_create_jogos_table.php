<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('data_jogo');
            
            $table->string('hora_jogo');
            
            $table->string('hora_jogo_final');
            
            $table->string('local');
            
            $table->integer('placar_time1');
            
            $table->integer('placar_time2');
            
            $table->integer('time1_id');
            $table->foreign('time1_id')->references('id')->on('times');
            
            $table->integer('time2_id');
            $table->foreign('time2_id')->references('id')->on('times');
            
            $table->integer('importancia');
            
            $table->integer('rodada_id');
            $table->foreign('rodada_id')->references('id')->on('rodadas');
            
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
        Schema::dropIfExists('jogos');
    }
}
