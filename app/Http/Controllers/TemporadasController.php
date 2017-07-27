<?php

namespace App\Http\Controllers;

use App\Temporada;
use App\TemporadaUsuario;
use App\Notification;

class TemporadasController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
    }

    public function index() {

        if (request()->isMethod('post')) {

            $temporadas = Temporada::where('nome', 'like', '%' . request('search') . '%')->get();
            
            return view('temporadas.index', compact('temporadas'));
        }
        return view('temporadas.index');
    }

    public function criar() {

        return view('temporadas.criar');
    }

    public function gravar() {

        $this->validate(request(), [
            'nome' => 'required',
            'rodadas' => 'required'
        ]);

        $temp = new Temporada;

        $temp->nome = request('nome');
        $temp->rodadas = request('rodadas');
        $temp->usuario_id = auth()->user()->id;

        $temp->save();

        $temp_usu= new TemporadaUsuario;

        $temp_usu->usuario_id = auth()->user()->id;
        $temp_usu->temporada_id = $sea->id;
        $temp_usu->aceito = TRUE;

        $temp_usu->save();

        session()->flash('message', 'Temporada Criada.');

        return redirect('/');
    }

    public function editar(Temporada $temporada) {

        if (auth()->user()->id !== $temporada->usuario_id) {

            session()->flash('message', 'Sem permissão para editar esta temporada.');

            return redirect('/');
        }

        return view('temporadas.editar', compact('temporada'));
    }

    public function atualizar(Temporada $temporada) {

        $this->validate(request(), [
            'nome' => 'required',
            'rodadas' => 'required'
        ]);

        $temporada->update(request()->all());

        session()->flash('message', 'Temporada Atualizada.');

        return redirect('/');
    }

    public function mostrar(Temporada $temporada) {

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
        
        return view('temporadas.mostrar', compact(['temporada', 'temporada_usuario', 'ranking', 'my_rank']));
    }

    public function request(Temporada $temporada) {

        $temporada_usuario = TemporadaUsuario::where('temporada_id', '=', $temporada->id)
                ->where('usuario_id', '=', auth()->user()->id)
                ->get();

        if (!$temporada_usuario->isEmpty()) {

            if ($temporada_usuario->aceito) {
                session()->flash('message', 'VOCÊ JÁ PARTICIPA DESSA TEMPORADA!');
                return back();
            } else {
                session()->flash('message', 'UMA SOLICITAÇÃO JÁ FOI ENVIADA, AGUARDE!');
                return back();
            }
        }

        $temporada_usuario = new TemporadaUsuario;
        $temporada_usuario->temporada_id = $temporada->id;
        $temporada_usuario->usuario_id = auth()->user()->id;
        $temporada_usuario->aceito = FALSE;

        $temporada_usuario->save();


        $notif = new Notification;
        $notif->do_usuario_id = auth()->user()->id;
        $notif->para_usuario_id = $temporada->user_id;
        $notif->temporada_usuario_id = $temporada->id;
        $notif->descricao = 'quer participar da temporada ' . $temporada->nome;
        $notif->lido = FALSE;

        $notif->save();

        session()->flash('message', 'SOLICITAÇÃO ENVIADA.');

        return back();
    }

    public function request_accepted(TemporadaUsuario $temporada_usuario) {
        if (!$temporada_usuario->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $temporada_usuario->aceito = TRUE;

        $temporada_usuario->update();

        session()->flash('message', 'JOGADOR ADICIONADO.');

        return redirect('/notificacoes');
    }

    public function request_denied(TemporadaUsuario $temporada_usuario) {
        if (!$temporada_usuario->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $temporada_usuario->delete();

        session()->flash('message', 'JOGADOR NEGADO.');

        return redirect('/notifications');
    }

    public function denied(TemporadaUsuario $temporada_usuario) {
        if (!$temporada_usuario->exists()) {
            session()->flash('message', 'SOLICITAÇÃO NÃO EXISTE.');
            return redirect('/notifications');
        }

        $temporada_usuario->delete();

        session()->flash('message', 'VOCÊ SAIU DESTA TEMPORADA.');

        return redirect('/temporadas/' . $temporada_usuario->temporada_id);
    }

}
