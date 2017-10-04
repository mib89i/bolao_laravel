<?php

namespace App;

class RodadaFinalizadaVisualizada extends Model {
    
    protected $table = 'rodada_finalizada_visualizada';

    
    public function rodada_finalizada() {

        return $this->belongsTo(RodadaFinalizada::class);
        
    }

}
