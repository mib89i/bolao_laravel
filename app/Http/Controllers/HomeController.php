<?php

namespace App\Http\Controllers;

use App\TemporadaUsuario;
use App\Usuario;

class HomeController extends Controller
{
    
    public function index(){
        if (auth()->check()){
            $temporada_usuarios = TemporadaUsuario::where(['usuario_id' => auth()->user()->id])->get();
        }
        return view('index', compact('temporada_usuarios'));
        
    }
    
}
