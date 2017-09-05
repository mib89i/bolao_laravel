<?php

namespace App\Http\Controllers;

use App\Temporada;
use App\Rodada;
use App\Jogo;

class RodadaController extends Controller {

    public function __construct() {

        $this->middleware('auth')->except([]);
    }

    public function index() {
        $lista_rodada = Rodada::where('usuario_id', '=', auth()->user()->id)->orderBy('id')->get();
        
        return view('rodada.index', compact('lista_rodada'));
    }
    
    public function criar() {

        $lista_temporada = Temporada::where('usuario_id', '=', auth()->user()->id)->get();
        
        return view('rodada.criar', compact('lista_temporada'));
        
    }
    
    public function criarRodada(Temporada $temporada) {

        //$ultima_rodada = Rodada::where('temporada_id', '=', $temporada->id)->orderByRaw('min(created_at) desc')->get();
        $ultima_rodada = Rodada::latest('temporada_id', '=', $temporada->id)->first();
        
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
            $rodada->usuario_id = auth()->user()->id;
            $rodada->temporada_id = $temporada->id;

            $rodada->save();

            session()->flash('message', 'Rodada Criada.');

            \DB::commit();

            return redirect('/rodada/'.$rodada->id.'/editar/t/'.$temporada->id);
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao salvar temporada.' . $e);
        }

        return redirect('/rodada/criar');
        
    }
    
    public function editarRodada(Rodada $rodada, Temporada $temporada) {
        
        return view('rodada.editar_rodada', compact('temporada', 'rodada'));
        
    }
    
    public function adicionarJogoRodada(Rodada $rodada, Temporada $temporada) {
        $this->validate(request(), [
            'data_jogo' => 'required',
            'hora_jogo' => 'required'
        ]);

        if (empty(request('local'))){
            $local = 'Indefinido';
        }else{
            $local = request('local');
        }
        
        \DB::beginTransaction();

        try {
            $jogo = new Jogo;
            $jogo->local = $local;
            $jogo->data_jogo = request('data_jogo');
            $jogo->hora_jogo = request('hora_jogo');
            $jogo->importancia = request('importancia');
            $jogo->time1 = NULL;
            $jogo->time2 = NULL;
            
            $jogo->save();

            session()->flash('message', 'JOGO ADICIONADO');

            \DB::commit();

            return redirect('/rodada/'.$rodada->id.'/editar/t/'.$temporada->id);
        } catch (\Exception $e) {
            \DB::rollback();
            session()->flash('message', 'Erro ao ADICIONAR JOGO.' . $e);
        }
        return redirect('/rodada/'.$rodada->id.'/editar/t/'.$temporada->id);
        
    }

}
