<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Game;
use App\Team;

class GamesController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
    }

    public function create_sgame(Season $season) {
        $round_game = Game::where('season_id', '=', $season->id)->count() + 1;

        return view('games.create', compact(['season', 'round_game']));
    }
    
    public function put_session_team1(Team $team) {
        if (request()->ajax()) {
            session()->put('team1', $team);
        }
    }

    public function store_sgame(Season $season) {
        return view('games.create', compact('season'));
    }

    public function search_team() {

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

    public function get_list_teams() {
        if (!empty(request()->search_params)) {
            $teams = Team::where('name', 'ilike', '%' . request()->search_params . '%')->limit('5')->get();
        } else {
            $teams = array();
        }
        
        $type_team = request()->team_params;

        return view('games.ajax.teams', compact(['teams', 'type_team']));
    }
    
    public function get_select_teams() {
        $team1 = session('team1');
        if (!empty(request()->team1_id)){
            $team1 = Team::where('id', '=', request()->team1_id)->first();
            session()->put('team1', $team1);
        }
        
        $team2 = session('team2');
        if (!empty(request()->team2_id)){
            $team2 = Team::where('id', '=', request()->team2_id)->first();
            session()->put('team2', $team2);
        }
        
        return view('games.ajax.select_teams', compact(['team1', 'team2']));
    }

}
