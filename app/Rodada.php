<?php

namespace App;

class Rodada extends Model {

    protected $table = 'rodadas';

    public function temporada() {

        return $this->belongsTo(Temporada::class);
    }

    public function usuario() {

        return $this->belongsTo(Usuario::class);
    }

    public function jogo() {

        return $this->hasMany(Jogo::class)
                        ->orderBy('data_jogo', 'asc')
                        ->orderBy('hora_jogo', 'asc')
                        ->orderBy('id', 'asc');
    }

    public function pontos_rodada(Usuario $usuario) {
        return \DB::select(\DB::raw('SELECT func_pontos_rodada(' . $this->id . ', ' . $usuario->id . ') AS pontos'))[0];
    }

    public function pontos_rodada_destaque(Temporada $temporada) {
        return \DB::select(\DB::raw(
                                'SELECT u.id, u.nome, func_pontos_rodada(r.id, u.id) AS pontos_rodada
                                   FROM usuarios u
                                  INNER JOIN rodadas r ON r.id = ' . $this->id . '
                                  WHERE r.temporada_id = ' . $temporada->id . '
                                    AND u.id IN (SELECT tu.usuario_id FROM temporada_usuario tu WHERE tu.temporada_id = ' . $temporada->id . ')
                                  ORDER BY func_pontos_rodada(r.id, u.id) DESC, u.id DESC')
                );
    }

}
