<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisaoUsuarioTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('divisao_usuario', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('temporada_divisao_id')->unsigned();
            $table->foreign('temporada_divisao_id')->references('id')->on('temporada_divisao');

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
    public function down() {
        Schema::dropIfExists('divisao_usuario');
    }

}
