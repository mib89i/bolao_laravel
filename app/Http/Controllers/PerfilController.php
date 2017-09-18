<?php

namespace App\Http\Controllers;

use App\Usuario;

class PerfilController extends Controller
{

    public function index() {
        
        return view('perfil.index');
    
    }
    
    public function perfilUsuario(Usuario $usuario, $nome) {
        
        return view('perfil.perfil_usuario', compact('usuario'));
    
    }
}
