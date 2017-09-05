<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convites', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('temporada_id')->nullable();
            $table->foreign('temporada_id')->references('id')->on('temporadas');
            
            $table->integer('liga_id')->nullable();
            $table->foreign('liga_id')->references('id')->on('ligas');
                        
            $table->integer('do_usuario_id');
            $table->foreign('do_usuario_id')->references('id')->on('usuarios');
            
            $table->integer('para_usuario_id');
            $table->foreign('para_usuario_id')->references('id')->on('usuarios');
            
            $table->boolean('aceito')->nullable();
            
            $table->string('tipo');
            
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
        Schema::dropIfExists('convites');
    }
}
