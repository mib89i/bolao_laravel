<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingTemporadaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ranking_temporada', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('divisao_usuario_id');
            $table->foreign('divisao_usuario_id')->references('id')->on('divisao_usuario');

            $table->integer('pontos');
            
            $table->integer('posicao');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ranking_temporada');
    }

}
