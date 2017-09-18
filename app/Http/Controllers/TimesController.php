<?php

namespace App\Http\Controllers;

use App\Time;

class TimesController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
        
    }

    public function getListaTime() {
        
        if (!empty(request()->nome_time)) {
            $lista_time = Time::pesquisa_times(request()->nome_time);
        } else {
            $lista_time = array();
        }

        $time_selecionado = 1;
        
        return view('times.ajax.lista_pesquisa_time', compact('lista_time', 'time_selecionado'));
    }

    public function getListaTime2() {

        if (!empty(request()->nome_time)) {
            $lista_time = Time::pesquisa_times(request()->nome_time);
        } else {
            $lista_time = array();
        }

        $time_selecionado = 2;
        
        return view('times.ajax.lista_pesquisa_time', compact('lista_time', 'time_selecionado'));
    }

    public function getQueryListaTime() {

        return $lista_time;
    }

    public function selecionarTime(Time $time, $tipo_time) {
        if ($tipo_time == 1) {
            session()->put('time1_selecionado', $time);
        } else {
            session()->put('time2_selecionado', $time);
        }
        
        return view('times.ajax.time_selecionado_rodada');
    }

    public function tirarTime1(Time $time) {
        
    }

}
