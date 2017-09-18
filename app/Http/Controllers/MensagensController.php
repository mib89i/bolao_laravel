<?php

namespace App\Http\Controllers;

use App\Mensagem;

class MensagensController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth')->except([]);
        
    }
    
    public function index(){
        
        $lista_mensagem_ler = Mensagem::mensagem_ler();
        
        foreach($lista_mensagem_ler as $mensagem){
            $mensagem->lido = TRUE;
            
            $mensagem->update();
        }
        
        $lista_mensagem = Mensagem::mensagens();
        
        return view ('mensagens.index', compact('lista_mensagem'));
    }
}
