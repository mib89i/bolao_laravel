<?php

namespace App;

class TemporadaDivisao extends Model
{
    protected $table = 'temporada_divisao';
    
    public function temporada(){
        
        return $this->belongsTo(Temporada::class);
        
    }
    
}
