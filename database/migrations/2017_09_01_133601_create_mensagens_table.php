<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('do_usuario_id')->unsigned();
            $table->foreign('do_usuario_id')->references('id')->on('usuarios');
            
            $table->integer('para_usuario_id')->unsigned();
            $table->foreign('para_usuario_id')->references('id')->on('usuarios');
            
            $table->integer('convite_id')->unsigned();
            $table->foreign('convite_id')->references('id')->on('convites');
            
            $table->text('descricao');
            
            $table->boolean('lido');
            
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
        Schema::dropIfExists('mensagens');
    }
}
