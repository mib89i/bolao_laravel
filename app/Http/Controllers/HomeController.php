<?php

namespace App\Http\Controllers;

use App\TemporadaUsuario;
use App\RodadaFinalizada;
use App\RodadaFinalizadaVisualizada;
use App\Temporada;
use App\Rodada;

class HomeController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except(['index', 'login']);
    }

    public function index() {

        if (auth()->check()) {
            //$temporada_usuarios = TemporadaUsuario::where(['usuario_id' => auth()->user()->id])->get();
            $temporada_usuarios = TemporadaUsuario::whereHas('temporada', function($q) {
                                $q->where('ativa', '=', TRUE);
                                $q->where('concluida', '=', FALSE);
                            })
                            ->where(['usuario_id' => auth()->user()->id])->get();

//            $rodada_finalizada = \DB::select(\DB::raw(
//                                    '  SELECT rf.*
//                                 FROM rodada_finalizada rf 
//                                 LEFT JOIN rodada_finalizada_visualizada rfv ON rf.id = rfv.rodada_finalizada_id AND rfv.usuario_id = ' . auth()->user()->id . '
//                                INNER JOIN rodadas r ON r.id = rf.rodada_id
//                                INNER JOIN temporadas t ON t.id = r.temporada_id
//                                INNER JOIN temporada_usuario tu ON tu.temporada_id = t.id AND tu.usuario_id = ' . auth()->user()->id . '
//                                WHERE rfv.id IS NULL
//                                ORDER BY r.id
//                            ')
//            );
//
//            if ($rodada_finalizada != null) {
//                $rodada_finalizada = $rodada_finalizada[0];
//            } else {
//                $rodada_finalizada = NULL;
//            }
            //return dd($rodada_finalizada);

            $rodada_finalizada = RodadaFinalizada::leftJoin('rodada_finalizada_visualizada', function ($join) {
                        $join->on('rodada_finalizada.id', '=', 'rodada_finalizada_visualizada.rodada_finalizada_id')
                        ->where('rodada_finalizada_visualizada.usuario_id', '=', auth()->user()->id);
                    })
                    ->join('rodadas', 'rodadas.id', '=', 'rodada_finalizada.rodada_id')
                    ->join('temporadas', 'temporadas.id', '=', 'rodadas.temporada_id')
                    ->join('temporada_usuario', function ($join) {
                        $join->on('temporada_usuario.temporada_id', '=', 'temporadas.id')
                        ->where('temporada_usuario.usuario_id', '=', auth()->user()->id);
                    })
                    ->select('rodada_finalizada.*')
                    ->whereNull('rodada_finalizada_visualizada.id')
                    ->first();

            if ($rodada_finalizada != NULL) {
                $lista_melhores = Temporada::ranking_rodada(Rodada::where('id', $rodada_finalizada->rodada_id)->first(), 5);
            } else {
                $lista_melhores = NULL;
            }
            

            //->toSql();
//            foreach($temporada_usuarios as $tem_usu){
//                $tem_usu_in += $tem_usu->id;
//            }
            //$lista_rodada = Rodada::where(['temporada_id' => auth()->user()->id])->get();
            //mostra rodadas daquele usuario
            //$lista_rodada = Rodada::whereRaw('temporada_id IN (SELECT tu.temporada_id FROM temporada_usuario tu WHERE tu.usuario_id = ' . auth()->user()->id . ')')->get();
        }
        return view('index', compact('temporada_usuarios', 'rodada_finalizada', 'lista_melhores'));
    }

    public function visualizaRodada(RodadaFinalizada $rodada_finalizada) {

        \DB::beginTransaction();

        try {
            $rodada_finalizada_visualizada = new RodadaFinalizadaVisualizada;

            $rodada_finalizada_visualizada->rodada_finalizada_id = $rodada_finalizada->id;

            $rodada_finalizada_visualizada->usuario_id = auth()->user()->id;

            $rodada_finalizada_visualizada->save();

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'ERRO AO ATUALIZAR STATUS DA RODADA ' . $e);
        }

        return back();
    }

}
