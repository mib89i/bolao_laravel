<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRodadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodadas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nome');
            
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            
            $table->integer('temporada_id');
            $table->foreign('temporada_id')->references('id')->on('temporadas');
            
            $table->integer('liga_id');
            $table->foreign('liga_id')->references('id')->on('ligas');

            $table->boolean('concluida');
            
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
        Schema::dropIfExists('rodadas');
    }
}
