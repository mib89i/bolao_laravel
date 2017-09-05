<?php

namespace App\Http\Controllers;

use App\TemporadaUsuario;
use App\Rodada;


class HomeController extends Controller
{
    
    public function index(){
        if (auth()->check()){
            $temporada_usuarios = TemporadaUsuario::where(['usuario_id' => auth()->user()->id])->get();
            
            $lista_rodada = Rodada::where(['usuario_id' => auth()->user()->id])->get();
        }
        return view('index', compact('temporada_usuarios', 'lista_rodada'));
        
    }
    
}
