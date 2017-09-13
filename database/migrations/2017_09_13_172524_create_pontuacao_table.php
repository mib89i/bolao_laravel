<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontuacaoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pontuacao', function (Blueprint $table) {
            $table->increments('id');

            $table->string('descricao');

            $table->integer('pontos');

            $table->timestamps();
        });

        DB::table('pontuacao')->insert(
                array(
                    'descricao' => 'Acertou Quem Ganhou',
                    'pontos' => '5',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('pontuacao')->insert(
                array(
                    'descricao' => 'Bônus (Acerto Placar)',
                    'pontos' => '20',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('pontuacao')->insert(
                array(
                    'descricao' => 'Errou o Placar',
                    'pontos' => '0',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                )
        );
        
        DB::table('pontuacao')->insert(
                array(
                    'descricao' => 'Acertou o Empate',
                    'pontos' => '5',
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
        Schema::dropIfExists('pontuacao');
    }

}
