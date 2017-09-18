<?php

namespace App\Http\Controllers;

use App\Temporada;
use App\Rodada;
use App\Jogo;
use App\Palpite;
use App\RankingTemporada;
use App\DivisaoUsuario;

class RodadaController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
        
    }

    public function index() {
        
        $lista_rodada = Rodada::where('usuario_id', '=', auth()->user()->id)->orderBy('id')->get();

        return view('rodada.index', compact('lista_rodada'));
    }

    public function mostrar(Rodada $rodada) {

        $pontuacao_parcial = \DB::select(
                        \DB::raw('SELECT func_pontos_rodada(' . $rodada->id . ', ' . auth()->user()->id . ') AS pontos_rodada')
                )[0];

        return view('rodada.mostrar', compact('rodada', 'pontuacao_parcial'));
    }

    public function criar() {

        $lista_temporada = Temporada::where('usuario_id', '=', auth()->user()->id)
                ->where('ativa', '=', TRUE)
                ->get();

        return view('rodada.criar', compact('lista_temporada'));
    }

    public function criarRodada(Temporada $temporada) {

        $ultima_rodada = Rodada::where('temporada_id', '=', $temporada->id)->orderBy('created_at', 'desc')->first();

        //$ultima_rodada = Rodada::latest('temporada_id', '=', $temporada->id)->first();

        return view('rodada.criar_rodada', compact('temporada', 'ultima_rodada'));
    }

    public function gravarRodada(Temporada $temporada) {
        $this->validate(request(), [
            'nome' => 'required'
        ]);

        \DB::beginTransaction();

        try {
            $rodada = new Rodada;
            $rodada->nome = request('nome');
            $rodada->numero = request('numero');
            $rodada->concluida = FALSE;
            $rodada->publicada = FALSE;
            $rodada->usuario_id = auth()->user()->id;
            $rodada->temporada_id = $temporada->id;

            $rodada->save();

            session()->flash('message', 'Rodada Criada.');

            \DB::commit();

            return redirect('/rodada/' . $rodada->id . '/editar/t/' . $temporada->id);
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao salvar temporada.' . $e);
        }

        return redirect('/rodada/criar/t/'.$temporada->id);
    }

    public function editarRodada(Rodada $rodada, Temporada $temporada) {

        $this->limpar();

        $lista_jogos = Jogo::where(['rodada_id' => $rodada->id])
                ->orderBy('data_jogo', 'asc')
                ->orderBy('hora_jogo', 'asc')
                ->orderBy('id', 'asc')
                ->get();

        return view('rodada.editar_rodada', compact('temporada', 'rodada', 'lista_jogos'));
    }

    public function atualizarRodada(Rodada $rodada, Temporada $temporada) {
        $this->validate(request(), [
            'nome' => 'required'
        ]);

        \DB::beginTransaction();

        try {
            $rodada->nome = request('nome');
            //$rodada->publicada = (request('publicada') == null) ? FALSE : TRUE;
            $rodada->publicada = (request('publicada') === null) ? FALSE : TRUE;

            $rodada->update();

            session()->flash('message', 'RODADA ATUALIZADA');

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao ATUALIZAR RODADA.' . $e);
        }

        $lista_jogos = Jogo::where(['rodada_id' => $rodada->id])
                ->orderBy('data_jogo', 'asc')
                ->orderBy('hora_jogo', 'asc')
                ->orderBy('id', 'asc')
                ->get();

        return view('rodada.editar_rodada', compact('temporada', 'rodada', 'lista_jogos'));
    }

    public function excluir(Rodada $rodada) {

        \DB::beginTransaction();

        try {
            $rodada->jogo()->delete();

            $rodada->delete();

            session()->flash('message', 'RODADA EXCLUÍDA');

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao EXCLUIR RODADA.' . $e);
        }

        return redirect('/');
    }

    public function adicionarJogoRodada(Rodada $rodada, Temporada $temporada) {
        $this->validate(request(), [
            'data_jogo' => 'required',
            'hora_jogo' => 'required'
        ]);

        if (empty(request('local'))) {
            $local = 'Indefinido';
        } else {
            $local = request('local');
        }

        if (!session()->has('time1_selecionado') || !session()->has('time2_selecionado')) {
            session()->flash('message', 'SELECIONE OS TIMES DESSE JOGO');
            return redirect('/rodada/' . $rodada->id . '/editar/t/' . $temporada->id);
        }

        \DB::beginTransaction();

        try {
            $jogo = new Jogo;
            $jogo->local = $local;
            $jogo->data_jogo = request('data_jogo');
            $jogo->hora_jogo = request('hora_jogo');
            $jogo->importancia = (request('importancia') == NULL) ? 1 : request('importancia');
            $jogo->time1_id = session()->get('time1_selecionado')->id;
            $jogo->time2_id = session()->get('time2_selecionado')->id;
            $jogo->rodada_id = $rodada->id;

            $jogo->save();

            session()->flash('message', 'JOGO ADICIONADO');

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao ADICIONAR JOGO.' . $e);
        }

        $this->limpar();

        return redirect('/rodada/' . $rodada->id . '/editar/t/' . $temporada->id);
    }

    public function limparSessao(Rodada $rodada) {
        $this->limpar();
        return redirect('/rodada/' . $rodada->id . '/editar/t/' . $rodada->temporada->id);
    }

    public function limpar() {
        session()->forget('time1_selecionado');
        session()->forget('time2_selecionado');
    }

    public function atualizarJogoRodada(Rodada $rodada, Jogo $jogo) {

        if (request('finalizar_jogo')) {
            $jogo->hora_jogo_final = date('H:i');
        }
        
        $jogo->placar_time1 = request('placar_time1');
        $jogo->placar_time2 = request('placar_time2');

        $jogo->update();

        session()->flash('message', 'JOGO ATUALIZADO COM SUCESSO');

        return redirect('/rodada/' . $rodada->id . '/editar/t/' . $rodada->temporada->id);
    }

    public function excluirJogoRodada(Rodada $rodada, Jogo $jogo) {

        \DB::beginTransaction();

        try {
            $jogo->palpites()->delete();

            $jogo->delete();

            session()->flash('message', 'JOGO EXCLUIDO');
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao EXCLUIR JOGO.' . $e);
        }

        return back();
    }

    public function terminarRodada(Rodada $rodada) {
        if ($rodada->concluida) {
            session()->flash('message', 'RODADA JÁ FOI CONCLUÍDA');
            return back();
        }

        if (!$rodada->publicada) {
            session()->flash('message', 'VOCÊ NÃO PODE TERMINAR UMA RODADA QUE NÃO FOI PUBLICADA');
            return back();
        }

        \DB::beginTransaction();
        
        try {

            foreach ($rodada->jogo as $jogo) {

                if ($jogo->placar_time1 === NULL || $jogo->placar_time2 === NULL) {
                    \DB::rollback();
                    session()->flash('message', 'JOGOS SEM PLACARES NÃO PODEM SER CONCLUÍDOS.');
                    return back();
                }

                if ($jogo->hora_jogo_final === NULL) {
                    $jogo->hora_jogo_final = date('H:i');

                    $jogo->update();
                }
                
            }

            $temporada = Temporada::where('id', '=', $rodada->temporada_id)->first();

            $lista_temporada_divisao = $temporada->temporada_divisao()->get();

            foreach ($lista_temporada_divisao as $temporada_divisao) {

                $lista_ranking_anterior = $temporada->ranking_atual($temporada_divisao);

                if (!empty($lista_ranking_anterior)) {
                    foreach ($lista_ranking_anterior as $rank) {

                        $ranking_novo = new RankingTemporada;

                        $ranking_novo->divisao_usuario_id = $rank->divisao_usuario_id;
                        $ranking_novo->rodada_id = $rodada->id;
                        $ranking_novo->posicao_anterior = $rank->posicao;
                        $ranking_novo->pontos = $rank->pontos; //$rodada->pontos_rodada($rank->usuario_id)->pontos;
                        $ranking_novo->posicao = $rank->rank;
                        //$ranking_novo->variacao = $rank->variacao; 

                        $ranking_novo->save();
                    }
                }
            }

            $rodada->concluida = TRUE;

            $rodada->update();

            \DB::commit();
            session()->flash('message', 'RODADA TERMINADA COM SUCESSO ');
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'ERRO AO TERMINAR RODADA ' . $e);
        }



        return back();
    }

    public function gravarPalpite(Rodada $rodada) {

        \DB::beginTransaction();

        try {
            foreach (request('lista_jogos') as $jogo) {
                $palpite = Palpite::where('jogo_id', '=', $jogo['id'])
                        ->where('usuario_id', '=', auth()->user()->id)
                        ->first();

                $data = date('Y-m-d'); // DATA DE HOJE
                $hora = date('H:i'); // HORA DE HOJE

                $data_jogo = $jogo['data_jogo']; // DATA DO JOGO
                $hora_jogo = $jogo['hora_jogo']; // HORA DO JOGO

                if (strtotime($data) > strtotime($data_jogo) || $rodada->concluida) {
                    // JOGO JÁ PASSOU
                    continue;
                } else if (strtotime($data) == strtotime($data_jogo)) {
                    // VERIFICAR O HORÁRIO

                    if (strtotime($hora) > strtotime($jogo['hora_jogo'])) {
                        // HORA DO JOGO PASSOU
                        continue;
                    }
                }
                // CONTINUAR EDITANDO NORMAL


                if ($palpite == NULL) {
                    $palpite = new Palpite;
                    $palpite->placar_time1 = $jogo['placar_time1'];
                    $palpite->placar_time2 = $jogo['placar_time2'];
                    $palpite->usuario_id = auth()->user()->id;
                    $palpite->jogo_id = $jogo['id'];

                    $palpite->save();
                } else {
                    $palpite->placar_time1 = $jogo['placar_time1'];
                    $palpite->placar_time2 = $jogo['placar_time2'];

                    $palpite->update();
                }

                session()->flash('message', 'PALPITE GRAVADO');
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao GRAVAR PALPITE.' . $e);
        }

        return back();
    }

}
