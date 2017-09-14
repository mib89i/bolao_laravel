<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisao', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->timestamps();
        });
        
        
        DB::table('divisao')->insert(
                array(
                    'nome' => '1° Divisão',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('divisao')->insert(
                array(
                    'nome' => '2° Divisão',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('divisao')->insert(
                array(
                    'nome' => '3° Divisão',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('divisao')->insert(
                array(
                    'nome' => '4° Divisão',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisao');
    }
}
