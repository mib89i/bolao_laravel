<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook_id')->unique();
            $table->string('apelido')->nullable();
            $table->text('avatar');
            $table->text('avatar_original');
            $table->string('genero');
            $table->text('link');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::unprepared("CREATE OR REPLACE FUNCTION translate(character varying)
                        RETURNS character varying AS
                      ".'$BODY$'."

                      SELECT * from TRANSLATE($1, 
                      'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC'); 

                      ".'$BODY$'."
                        LANGUAGE sql VOLATILE
                        COST 100;
                      ALTER FUNCTION translate(character varying)
                        OWNER TO postgres;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
        
        DB::unprepared("DROP FUNCTION translate(character varying)");
    }
}
