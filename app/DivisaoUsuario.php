<?php

namespace App;

class DivisaoUsuario extends Model
{
    protected $table = 'divisao_usuario';
    
    public function usuario(){
        
        return $this->belongsTo(Usuario::class);
        
    }
    
    public function temporada_divisao(){
        
        return $this->belongsTo(TemporadaDivisao::class);
        
    }
    
}
