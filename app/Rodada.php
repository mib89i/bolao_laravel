<?php

namespace App;

class Rodada extends Model
{
    protected $table = 'rodadas';
    
    public function temporada(){
        
        return $this->belongsTo(Temporada::class);
        
    }
    
    public function usuario(){
        
        return $this->belongsTo(Usuario::class);
        
    }
    
    
}
