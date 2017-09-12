<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->string('sigla');

            $table->string('logo');

            $table->timestamps();
        });
        
        DB::table('times')->insert(
                array(
                    'nome' => 'Corinthians',
                    'sigla' => 'COR',
                    'logo' => 'corinthians.png',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        DB::table('times')->insert(
                array(
                    'nome' => 'São Paulo',
                    'sigla' => 'SAO',
                    'logo' => 'sao-paulo.png',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        DB::table('times')->insert(
                array(
                    'nome' => 'Palmeiras',
                    'sigla' => 'PAL',
                    'logo' => 'palmeiras.png',
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
    public function down() {
        Schema::dropIfExists('times');
    }

}
