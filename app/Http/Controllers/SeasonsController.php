<?php

namespace App\Http\Controllers;

use App\Temporada;
use App\TemporadaUsuario;
use App\Notification;

class SeasonsController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
    }

    public function index() {

        if (request()->isMethod('post')) {

            $seasons = Temporada::where('nome', 'like', '%' . request('search') . '%')->get();
            //$seasons = Season::where('id', '=', '1')->get();
            //return dd($seasons);

            return view('seasons.index', compact('seasons'));
        }
        return view('seasons.index');
    }

    public function create() {

        return view('seasons.create');
    }

    public function store() {

        $this->validate(request(), [
            'nome' => 'required',
            'rodadas' => 'required'
        ]);

        $sea = new Temporada;

        $sea->nome = request('nome');
        $sea->rodadas = request('rodadas');
        $sea->usuario_id = auth()->user()->id;

        $sea->save();

        $sea_use = new TemporadaUsuario;

        $sea_use->usuario_id = auth()->user()->id;
        $sea_use->temporada_id = $sea->id;
        $sea_use->aceito = TRUE;

        $sea_use->save();

//        Season::create([
//            'name' => request('name'),
//            'rounds' => request('rounds'),
//            'user_id' => auth()->user()->id
//        ]);

        session()->flash('message', 'Temporada Criada.');

        return redirect('/');
    }

    public function edit(Temporada $temporada) {

        if (auth()->user()->id !== $temporada->usuario_id) {

            session()->flash('message', 'Sem permissão para editar esta temporada.');

            return redirect('/');
        }

        return view('seasons.edit', compact('temporada'));
    }

    public function update(Temporada $temporada) {

        $this->validate(request(), [
            'nome' => 'required',
            'rodadas' => 'required'
        ]);

        $temporada->update(request()->all());

        session()->flash('message', 'Temporada Atualizada.');

        return redirect('/');
    }

    public function show(Temporada $temporada) {

        $temporada_usuario = TemporadaUsuario::where('temporada_id', '=', $temporada->id)
                ->where('usuario_id', '=', auth()->user()->id)
                ->first();

        $ranking = \DB::select(
        \DB::raw('SELECT u.id,
                        u.nome,
                        u.avatar,
                        rank() over(ORDER BY u.id DESC)
                   FROM usuarios u
                  INNER JOIN temporada_usuario tu ON tu.usuario_id = u.id AND tu.aceito = TRUE AND tu.temporada_id = ' . $temporada->id
                )
        );
        
        foreach ($ranking as $rank){
            if ($rank->id === auth()->user()->id){
                $my_rank = $rank;
                break;
            }
        }
        
        return view('seasons.show', compact(['temporada', 'temporada_usuario', 'ranking', 'my_rank']));
    }

    public function request(Season $season) {

        $season_user = SeasonUser::where('season_id', '=', $season->id)
                ->where('user_id', '=', auth()->user()->id)
                ->get();

        if (!$season_user->isEmpty()) {

            if ($season_user->accepted) {
                session()->flash('message', 'VOCÊ JÁ PARTICIPA DESSA TEMPORADA!');
                return back();
            } else {
                session()->flash('message', 'UMA SOLICITAÇÃO JÁ FOI ENVIADA, AGUARDE!');
                return back();
            }
        }

        $season_user = new SeasonUser;
        $season_user->season_id = $season->id;
        $season_user->user_id = auth()->user()->id;
        $season_user->accepted = FALSE;

        $season_user->save();


        $notif = new Notification;
        $notif->from_user_id = auth()->user()->id;
        $notif->to_user_id = $season->user_id;
        $notif->season_user_id = $season_user->id;
        $notif->description = 'quer participar da temporada ' . $season->name;
        $notif->readed = FALSE;

        $notif->save();

        session()->flash('message', 'SOLICITAÇÃO ENVIADA.');

        return back();
    }

    public function request_accepted(SeasonUser $season_user) {
        if (!$season_user->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $season_user->accepted = TRUE;

        $season_user->update();

        session()->flash('message', 'JOGADOR ADICIONADO.');

        //return redirect('/seasons/' . $season_user->season_id);
        return redirect('/notifications');
    }

    public function request_denied(SeasonUser $season_user) {
        if (!$season_user->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $season_user->delete();

        session()->flash('message', 'JOGADOR NEGADO.');

        return redirect('/notifications');
    }

    public function denied(SeasonUser $season_user) {
        if (!$season_user->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $season_user->delete();

        session()->flash('message', 'VOCÊ SAIU DESTA TEMPORADA.');

        return redirect('/seasons/' . $season_user->season_id);
    }

}
