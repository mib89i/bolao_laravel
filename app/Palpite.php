<?php

namespace App;

class Palpite extends Model {

    protected $table = 'palpites';

    public function usuario() {

        return $this->belongsTo(Usuario::class);
    }

    public function jogo() {

        return $this->belongsTo(Jogo::class);
    }

    public function pontos_palpite() {
        return \DB::select(\DB::raw('SELECT func_pontos_palpite(' . $this->id . ') AS pontos'))[0];
    }

}
