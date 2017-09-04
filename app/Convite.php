<?php

namespace App;

class Convite extends Model
{
    protected $table = 'convites';
    
    public function temporada(){
        
        return $this->belongsTo(Temporada::class);
        
    }
    
    public function liga(){
        
        //return $this->belongsTo(Liga::class);
        
    }
    
}
