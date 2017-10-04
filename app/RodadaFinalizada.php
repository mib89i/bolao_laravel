<?php

namespace App;

class RodadaFinalizada extends Model {
    
    protected $table = 'rodada_finalizada';


    public function usuario() {

        return $this->belongsTo(Usuario::class, 'destaque_usuario_id');
        
    }
    
    public function rodada() {

        return $this->belongsTo(Rodada::class);
        
    }
}
