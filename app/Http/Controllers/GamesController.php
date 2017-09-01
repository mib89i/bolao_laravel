<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use App\Game;
use App\Time;

class GamesController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
    }

    public function create_sgame(Temporada $temporada) {
        $round_game = Game::where('temporada_id', '=', $temporada->id)->count() + 1;

        return view('games.create', compact(['temporada', 'round_game']));
    }
    
    public function put_session_time1(Time $time) {
        if (request()->ajax()) {
            session()->put('time1', $time);
        }
    }

    public function store_sgame(Temporada $temporada) {
        return view('games.create', compact('temporada'));
    }

    public function search_time() {

        if (request()->ajax()) {

            return \Response::json(array(
                        'success' => true,
                        'data' => 'Worked ' . request()->param_search
            ));
        }

        return \Response::json(array(
                    'success' => false,
                    'data' => 'Dont Worked'
        ));
    }

    public function get_list_times() {
        if (!empty(request()->search_params)) {
            $times = Time::where('nome', 'ilike', '%' . request()->search_params . '%')->limit('5')->get();
        } else {
            $times = array();
        }
        
        $type_time = request()->time_params;

        return view('games.ajax.times', compact(['times', 'type_time']));
    }
    
    public function get_select_times() {
        $time1 = session('time1');
        if (!empty(request()->time1_id)){
            $time1 = Time::where('id', '=', request()->time1_id)->first();
            session()->put('time1', $time1);
        }
        
        $time2 = session('time2');
        if (!empty(request()->time2_id)){
            $time2 = Time::where('id', '=', request()->time2_id)->first();
            session()->put('time2', $time2);
        }
        
        return view('games.ajax.select_times', compact(['time1', 'time2']));
    }

}
