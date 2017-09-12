<?php

namespace App\Http\Controllers;

use App\TemporadaUsuario;
use App\Rodada;


class HomeController extends Controller
{
    
    public function index(){
        if (auth()->check()){
            //$temporada_usuarios = TemporadaUsuario::where(['usuario_id' => auth()->user()->id])->get();
            $temporada_usuarios = TemporadaUsuario::whereHas('temporada', function($q) {
                $q->where('ativa', '=', TRUE);
            })
            ->where(['usuario_id' => auth()->user()->id]) ->get();      
            
//            foreach($temporada_usuarios as $tem_usu){
//                $tem_usu_in += $tem_usu->id;
//            }

            //$lista_rodada = Rodada::where(['temporada_id' => auth()->user()->id])->get();
            //mostra rodadas daquele usuario
            //$lista_rodada = Rodada::whereRaw('temporada_id IN (SELECT tu.temporada_id FROM temporada_usuario tu WHERE tu.usuario_id = ' . auth()->user()->id . ')')->get();
        }
        return view('index', compact('temporada_usuarios'));
        
    }
    
}
