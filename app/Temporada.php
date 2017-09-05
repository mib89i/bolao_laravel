<?php

namespace App;

class Temporada extends Model {

    protected $table = 'temporadas';

    public function usuario() {

        return $this->belongsTo(Usuario::class);
    }

    public function temporada_usuario() {

        return $this->hasMany(TemporadaUsuario::class);
        
    }

    public function temporada_divisao() {

        return $this->hasMany(TemporadaDivisao::class);
        
    }

    public function rodada() {

        return $this->hasMany(Rodada::class);
        
    }

    public static function return_rank($usuario_id) {
        
    }

}
