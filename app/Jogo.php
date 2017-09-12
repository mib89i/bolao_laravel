<?php

namespace App;

class Jogo extends Model {

    protected $table = 'jogos';

    public function time1() {

        return $this->belongsTo(Time::class, 'time1_id');
        
    }
    
    public function time2() {

        return $this->belongsTo(Time::class, 'time2_id');
        
    }
    
    public function palpite() {

        return $this->hasOne(Palpite::class)
                ->where('usuario_id', '=', auth()->user()->id)
                ->where('jogo_id', '=', $this->id);
        
    }
    
//    public function data_jogo_string(){
//        //$data = \Carbon\Carbon::createFromFormat('d/m/Y', $this->attributes['data_jogo']);
//        $data = \Carbon\Carbon::createFromFormat('d-m-Y', '2016-01-23');
//        return $data;
//    }

}
