<?php

namespace App;

class TemporadaDivisao extends Model
{
    protected $table = 'temporada_divisao';
    
    public function temporada(){
        
        return $this->belongsTo(Temporada::class);
        
    }
    
    public function divisao_usuario(){
        
        return $this->hasMany(DivisaoUsuario::class);
        
    }
    
}
