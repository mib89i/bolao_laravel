<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporadaDivisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporada_divisao', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('temporada_id')->unsigned();
            $table->foreign('temporada_id')->references('id')->on('temporadas');
            
            $table->integer('divisao_id')->unsigned();
            $table->foreign('divisao_id')->references('id')->on('divisao');
            
            $table->integer('rodadas');
            
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
        Schema::dropIfExists('temporada_divisao');
    }
}
