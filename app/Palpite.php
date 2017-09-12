<?php

namespace App;

class Palpite extends Model
{
    protected $table = 'palpites';
    
    public function usuario(){
        
        return $this->belongsTo(Usuario::class);
        
    }
    
    public function jogo(){
        
        return $this->belongsTo(Jogo::class);
        
    }
    
    
}
