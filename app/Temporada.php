<?php

namespace App;

class Temporada extends Model
{
    protected $table = 'temporadas';
    
    public function usuario(){
        
        return $this->belongsTo(Usuario::class);
        
    }
    
    public static function return_rank($usuario_id){
        
    }
}
