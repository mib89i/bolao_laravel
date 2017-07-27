<?php

namespace App;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    
    public function do_usuario(){
        
        //return $this->belongsTo(User::class, 'from_user_id', 'id');
        return $this->belongsTo(Usuario::class, 'do_usuario_id');
        
    }
    
    public function para_usuario(){
        
        return $this->belongsTo(Usuario::class, 'para_usuario_id');
        
    }
    
    public function temporada_usuario(){
        
        return $this->belongsTo(TemporadaUsuario::class);
        
    }
    
    public static function messages(){
        if (auth()->check()){
            return static::where('para_usuario_id', '=', auth()->user()->id)->latest()->get();
        }
        
        return null;
    }
    
    public static function messages_count(){
        if (auth()->check()){
            return static::where('para_usuario_id', '=', auth()->user()->id)
                    ->where('lido', '=', FALSE)
                    ->count();
        }
        
        return 0;
    }
    
    public static function messages_to_read(){
        if (auth()->check()){
            return static::where('para_user_id', '=', auth()->usuario()->id)
                    ->where('lido', '=', FALSE)->get();
        }
        
        return 0;
    }
}
