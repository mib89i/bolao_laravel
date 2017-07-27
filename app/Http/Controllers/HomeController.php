<?php

namespace App\Http\Controllers;

use App\TemporadaUsuario;
use App\Usuario;

class HomeController extends Controller
{
    
    public function index(){
        if (auth()->check()){
        $season_users = TemporadaUsuario::where(['usuario_id' => auth()->user()->id])->get();
        //$seasons = \DB::table('seasons')->get();
//        $seasons = \DB::select(
//                'SELECT s.* '
//                . 'FROM seasons s '
//                . 'WHERE s.user_id = ' . auth()->user_id
//                . ' '
//        )->get();
        
        //return dd($seasons);
        }
        return view('index', compact('season_users'));
        
    }
    
}
