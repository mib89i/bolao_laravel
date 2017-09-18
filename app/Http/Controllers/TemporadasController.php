<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Temporada;
use App\TemporadaUsuario;
use App\TemporadaDivisao;
use App\Convite;
use App\Mensagem;
use App\DivisaoUsuario;
use App\Divisao;

class TemporadasController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
        
    }

    public function index() {
        
        if (request()->isMethod('post')) {

            //$pesquisa = mb_strtolower(request('search'));

            $temporadas = Temporada::whereRaw('lower(translate(nome)) like lower(translate(' . '\'%' . request('search') . '%\'' . '))')
                    ->whereRaw('ativa = TRUE')
                    ->get();

            //dd(Temporada::whereRaw('translate(nome) like translate(' . '\'%'. request('search') . '%\''.')')->toSql());
            return view('temporadas.index', compact('temporadas'));
        }
        return view('temporadas.index');
    }

    public function criar() {

        return view('temporadas.criar');
        
    }

    public function gravar() {

        $this->validate(request(), [
            'nome' => 'required'
        ]);

        \DB::beginTransaction();

        try {
            $temp = new Temporada;
            $temp->nome = request('nome');
            $temp->publica = request('opcoes_publica') === 'publica' ? TRUE : FALSE;
            $temp->usuario_id = auth()->user()->id;

            $temp->save();

            $temp_usu = new TemporadaUsuario;

            $temp_usu->usuario_id = auth()->user()->id;
            $temp_usu->temporada_id = $temp->id;

            $temp_usu->save();

            session()->flash('message', 'Temporada Criada.');

            \DB::commit();

            return redirect('temporadas/' . $temp->id . '/editar');
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao salvar temporada.' . $e);
        }


        return redirect('/');
    }

    public function editar(Temporada $temporada) {

        if (auth()->user()->id !== $temporada->usuario_id) {

            session()->flash('message', 'Sem permissão para editar esta temporada.');

            return redirect('/');
        }

        $lista_temporada_divisao = TemporadaDivisao::where('temporada_id', '=', $temporada->id)->get();

        $lista_divisao = Divisao::select('id', 'nome')->get();
        
        return view('temporadas.editar', compact('temporada', 'lista_temporada_divisao', 'lista_divisao'));
    }

    public function temporadaDivisao(Temporada $temporada, $nome, Divisao $divisao) {

        $temporada_divisao = TemporadaDivisao::where('divisao_id', '=', $divisao->id)
                ->where('temporada_id', '=', $temporada->id)
                ->first();


        $temporada_usuario = TemporadaUsuario::where('temporada_id', '=', $temporada->id)
                ->where('usuario_id', '=', auth()->user()->id)
                ->first();

        $ranking = $temporada->ranking($temporada_divisao);

        foreach ($ranking as $rank) {
            if ($rank->id === auth()->user()->id) {
                $my_rank = $rank;
                break;
            }
        }

        return view('temporadas.divisao', compact('temporada', 'temporada_divisao', 'temporada_usuario', 'ranking', 'my_rank'));
    }

    public function atualizar(Temporada $temporada) {

        $this->validate(request(), [
            'nome' => 'required'
        ]);

        $temporada->nome = request('nome');
        $temporada->publica = request('opcoes_publica') === 'publica' ? TRUE : FALSE;

        $temporada->update();

        session()->flash('message', 'Temporada Atualizada.');

        return redirect('/');
    }

    public function excluir(Temporada $temporada) {
        
        \DB::beginTransaction();
        try {
            $temporada->ativa = FALSE;
            
            $temporada->update();

            session()->flash('message', 'Temporada Excluida.');
            
            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('message', 'Erro ao excluir temporada.' . $e);
            \DB::rollback();
        }
        return redirect('/');
    }

    public function mostrar(Temporada $temporada) {

        $lista_temporada_usuario = TemporadaUsuario::whereRaw('temporada_id = ' . $temporada->id)
                        ->whereRaw('usuario_id NOT IN (
                                    SELECT du.usuario_id FROM divisao_usuario du 
                                     INNER JOIN temporada_divisao td ON td.id = du.temporada_divisao_id
                                     WHERE td.temporada_id = ' . $temporada->id . '
                                    )'
                        )->get();

        $tem_temporada_usuario = TemporadaUsuario::where('temporada_id', '=', $temporada->id)
                ->where('usuario_id', '=', auth()->user()->id)
                ->first();

        $tem_convite_pendente = Convite::where('temporada_id', '=', $temporada->id)
                ->where('do_usuario_id', '=', auth()->user()->id)
                ->where('para_usuario_id', '=', $temporada->usuario_id)
                ->where('aceito', '=', NULL)
                ->first();

        return view('temporadas.mostrar', compact('temporada', 'lista_temporada_usuario', 'tem_temporada_usuario', 'tem_convite_pendente'));
    }

    public function adicionarDivisao(Temporada $temporada) {
        $this->validate(request(), [
            'rodadas' => 'required'
        ]);

        $temp_div = new TemporadaDivisao;

        $temp_div->temporada_id = $temporada->id;
        
        $temp_div->divisao_id = request('divisao');

        $temp_div->rodadas = request('rodadas');

        $temp_div->save();

        session()->flash('message', 'Divisão Adicionada');

        return redirect('temporadas/' . $temporada->id . '/editar');
    }

    public function getListaUsuario() {
        if (!empty(request()->nome_usuario)) {
            $lista_usuario = Usuario::whereRaw('lower(translate(nome)) like lower(translate(' . '\'%' . request()->nome_usuario . '%\'' . '))')
                    ->whereRaw('id <> ' . auth()->user()->id)
                    ->whereRaw('id not in (select tu.usuario_id from temporada_usuario tu where tu.temporada_id = ' . request()->temporada_id . ')')
                    ->limit('5')
                    ->get();

            $temporada = Temporada::find(request()->temporada_id);
        } else {
            $lista_usuario = array();
            $temporada_id = null;
        }


        return view('temporadas.ajax.lista_pesquisa_usuario', compact('lista_usuario', 'temporada'));
    }

    public function entrarTemporada(Temporada $temporada, $tipo_convite) {
        if ($temporada->publica === FALSE) {

            $convite = Convite::where('temporada_id', '=', $temporada->id)
                    ->where('do_usuario_id', '=', auth()->user()->id)
                    ->where('para_usuario_id', '=', $temporada->usuario_id)
                    ->where('aceito', '=', null)
                    ->where('tipo', '=', $tipo_convite)
                    ->get();

            if (!$convite->isEmpty()) {
                session()->flash('message', 'CONVITE JÁ ENVIADO, AGUARDANDO CONFIRMAÇÃO!');
                return redirect('/');
            }

            \DB::beginTransaction();
            try {
                $convite = new Convite;
                $convite->temporada_id = $temporada->id;
                $convite->liga_id = null;

                $convite->do_usuario_id = auth()->user()->id;
                $convite->para_usuario_id = $temporada->usuario_id;

                $convite->tipo = $tipo_convite;
                
                $convite->aceito = NULL;

                $convite->save();

                $mensagem = new Mensagem;

                $mensagem->do_usuario_id = auth()->user()->id;
                $mensagem->para_usuario_id = $temporada->usuario_id;
                $mensagem->convite_id = $convite->id;

                $mensagem->descricao = 'quer participar da temporada ' . $temporada->nome;
                $mensagem->lido = FALSE;

                $mensagem->save();

                session()->flash('message', 'Uma solicitação foi enviada ao administrador do Bolão, aguarde.');
                \DB::commit();
            } catch (\Exception $e) {
                session()->flash('message', 'Erro Enviar Solicitação.' . $e);
                \DB::rollback();
            }
        } else {
            $temporada_usuario = new TemporadaUsuario;
            $temporada_usuario->temporada_id = $temporada->id;
            $temporada_usuario->usuario_id = auth()->user()->id;

            $temporada_usuario->save();
        }

        return back();
    }

    public function sairTemporada(Temporada $temporada) {
        $temporada_usuario = TemporadaUsuario::where('temporada_id', '=', $temporada->id)
                ->where('usuario_id', '=', auth()->user()->id)
                ->first();

        $temporada_usuario->delete();

        session()->flash('message', 'VOCÊ SAIU');

        return back();
    }

    public function enviarConviteTemporada(Temporada $temporada, $tipo_convite, Usuario $usuario) {

        $convite = Convite::where('temporada_id', '=', $temporada->id)
                ->where('do_usuario_id', '=', auth()->user()->id)
                ->where('para_usuario_id', '=', $usuario->id)
                ->where('aceito', '=', null)
                ->where('tipo', '=', $tipo_convite)
                ->get();

        if (!$convite->isEmpty()) {
            session()->flash('message', 'CONVITE JÁ ENVIADO, AGUARDANDO CONFIRMAÇÃO!');
            return redirect('/');
        }

        \DB::beginTransaction();
        try {
            $convite = new Convite;
            $convite->temporada_id = $temporada->id;
            $convite->liga_id = null;

            $convite->do_usuario_id = auth()->user()->id;
            $convite->para_usuario_id = $usuario->id;

            $convite->tipo = $tipo_convite;

            $convite->aceito = NULL;

            $convite->save();

            $mensagem = new Mensagem;

            $mensagem->do_usuario_id = auth()->user()->id;
            $mensagem->para_usuario_id = $usuario->id;
            $mensagem->convite_id = $convite->id;

            $mensagem->descricao = 'convida você para participar da temporada ' . $temporada->nome;
            $mensagem->lido = FALSE;

            $mensagem->save();

            session()->flash('message', 'Convite Enviado.');
            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('message', 'Erro Enviar Convite.' . $e);
            \DB::rollback();
        }
        return back();
    }

    public function statusConvite(Temporada $temporada, Mensagem $mensagem, $status) {
        \DB::beginTransaction();
        try {
            if ($mensagem->convite->tipo === 'convidando') {
                $usu_id = $mensagem->convite->para_usuario_id;
            } else {
                $usu_id = $mensagem->convite->do_usuario_id;
            }

            if ($status === 'aceito') {
                $mensagem->convite->aceito = TRUE;
                $mensagem->convite->update();

                $temporada_usuario = new TemporadaUsuario;
                $temporada_usuario->temporada_id = $temporada->id;
                $temporada_usuario->usuario_id = $usu_id;

                $temporada_usuario->save();
            } else {
                $mensagem->convite->aceito = FALSE;
                $mensagem->convite->update();
            }

            \DB::commit();
        } catch (\Exception $e) {

            \DB::rollback();
        }

        return back();
    }

    public function adicionarUsuarioParaDivisao(TemporadaDivisao $temporada_divisao, Usuario $usuario) {
        $divisao_usuario = DivisaoUsuario::where('temporada_divisao_id', '=', $temporada_divisao->id)
                ->where('usuario_id', '=', $usuario->id)
                ->get();

        if (!$divisao_usuario->isEmpty()) {
            session()->flash('message', 'Jogador já esta participando.');
            return back();
        }

        $divisao_usuario = new DivisaoUsuario;

        $divisao_usuario->temporada_divisao_id = $temporada_divisao->id;
        $divisao_usuario->usuario_id = $usuario->id;

        $divisao_usuario->save();

        session()->flash('message', 'Jogador Adicionado para divisão ' . $temporada_divisao->nome);

        return back();
    }

    public function listaRodadas(Temporada $temporada) {
        
        return view('temporadas.lista_rodadas', compact('temporada'));
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


        $notif = new Notificacao;
        $notif->do_usuario_id = auth()->user()->id;
        $notif->para_usuario_id = $temporada->user_id;
        $notif->temporada_usuario_id = $temporada->id;
        $notif->descricao = 'quer participar da temporada ' . $temporada->nome;
        $notif->lido = FALSE;

        $notif->save();

        session()->flash('message', 'SOLICITAÇÃO ENVIADA.');

        return back();
    }
}
