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

        return $this->hasMany(Rodada::class)
                        ->where('publicada', '=', TRUE);
    }

    public function rodada_aberta() {

        return $this->hasMany(Rodada::class)
                        ->where('concluida', '=', FALSE)
                        ->where('publicada', '=', TRUE);
    }

    public function rodada_nao_publicada() {

        return $this->hasMany(Rodada::class)
                        ->where('concluida', '=', FALSE)
                        ->where('publicada', '=', FALSE)
                        ->where('usuario_id', '=', auth()->user()->id);
    }

    public static function minhas_temporadas() {

        if (auth()->check()) {
            return static::where('usuario_id', '=', auth()->user()->id)
                            ->count();
        }

        return 0;
    }

    public static function return_rank($usuario_id) {
        
    }

    public function scopeAtiva($query) {
        return $query->where('ativa', '=', TRUE);
    }

    public function ranking(TemporadaDivisao $temporada_divisao) {
        return \DB::select(
                        \DB::raw(
                                'SELECT u.id AS id,
                                        u.nome AS nome,
                                        u.avatar AS avatar,
                                        rank() over(ORDER BY COALESCE(rt.pontos, 0) DESC, u.nome ASC) AS rank,
                                        COALESCE(rt.pontos, 0) AS pontos,
                                        COALESCE(rt.posicao, 0) AS posicao,
                                        COALESCE(rt.posicao_anterior - rt.posicao, 0) AS variacao,
                                        du.id AS divisao_usuario_id
                                   FROM usuarios u
                                  INNER JOIN temporada_usuario tu ON tu.usuario_id = u.id
                                  INNER JOIN temporada_divisao td ON td.temporada_id = tu.temporada_id
                                  INNER JOIN divisao_usuario du ON du.temporada_divisao_id = td.id AND du.usuario_id = u.id
                                   LEFT JOIN ranking_temporada rt ON rt.divisao_usuario_id = du.id AND rt.id = (SELECT max(rx.id) FROM ranking_temporada rx WHERE rx.divisao_usuario_id = du.id)
                                   --LEFT JOIN ranking_temporada rt ON rt.divisao_usuario_id = du.id AND rt.rodada_id = (SELECT MAX(rod.id) FROM rodadas rod WHERE rod.temporada_id = ' . $temporada_divisao->temporada_id . ')
                                  WHERE tu.temporada_id = ' . $temporada_divisao->temporada_id . '
                                    AND td.id = ' . $temporada_divisao->id . ' LIMIT 20'
                        )
        );
    }

    public function ranking_atual(TemporadaDivisao $temporada_divisao) {
        return \DB::select(
                        \DB::raw(
                                'SELECT u.id AS id,
                                        u.nome AS nome,
                                        u.avatar AS avatar,
                                        rank() over(ORDER BY COALESCE(func_pontos_temporada_divisao(td.id, u.id), 0) DESC, u.nome ASC) AS rank,
                                        COALESCE(func_pontos_temporada_divisao(td.id, u.id), 0) AS pontos,
                                        COALESCE(rt.posicao, 0) AS posicao,
                                        COALESCE(rt.posicao_anterior - rt.posicao, 0) AS variacao,
                                        du.id AS divisao_usuario_id
                                   FROM usuarios u
                                  INNER JOIN temporada_usuario tu ON tu.usuario_id = u.id
                                  INNER JOIN temporada_divisao td ON td.temporada_id = tu.temporada_id
                                  INNER JOIN divisao_usuario du ON du.temporada_divisao_id = td.id AND du.usuario_id = u.id
                                   LEFT JOIN ranking_temporada rt ON rt.divisao_usuario_id = du.id AND rt.id = (SELECT max(rx.id) FROM ranking_temporada rx WHERE rx.divisao_usuario_id = du.id)
                                   --LEFT JOIN ranking_temporada rt ON rt.divisao_usuario_id = du.id AND rt.rodada_id = (SELECT MAX(rod.id) FROM rodadas rod WHERE rod.temporada_id = ' . $temporada_divisao->temporada_id . ')
                                  WHERE tu.temporada_id = ' . $temporada_divisao->temporada_id . '
                                    AND td.id = ' . $temporada_divisao->id . ' LIMIT 20'
                        )
        );
    }

    public static function ranking_rodada(Rodada $rodada, $limit) {
        return \DB::select(
                        \DB::raw(
                                'SELECT u.id AS id,
                                        u.nome AS nome,
                                        u.avatar AS avatar,
                                        rank() over(ORDER BY COALESCE(func_pontos_rodada(rt.rodada_id, u.id), 0) DESC, u.nome ASC) AS rank,
                                        COALESCE(func_pontos_rodada(rt.rodada_id, u.id), 0) AS pontos,
                                        COALESCE(rt.posicao, 0) AS posicao,
                                        COALESCE(rt.posicao_anterior - rt.posicao, 0) AS variacao,
                                        du.id AS divisao_usuario_id
                                    FROM usuarios u
                                   INNER JOIN temporada_usuario tu ON tu.usuario_id = u.id
                                   INNER JOIN temporada_divisao td ON td.temporada_id = tu.temporada_id
                                   INNER JOIN divisao_usuario du ON du.temporada_divisao_id = td.id AND du.usuario_id = u.id
                                    LEFT JOIN ranking_temporada rt ON rt.divisao_usuario_id = du.id
                                   WHERE rt.rodada_id = ' . $rodada->id . ' LIMIT ' . $limit
                        )
        );
    }

}
