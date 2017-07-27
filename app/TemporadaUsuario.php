<?php

namespace App;

class TemporadaUsuario extends Model
{
    protected $table = 'temporada_usuario';
    
    public function temporada(){
        
        return $this->belongsTo(Temporada::class);
        
    }
    
    public function usuario(){
        
        return $this->belongsTo(Usuario::class);
        
    }
}
