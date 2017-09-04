<?php

namespace App;

class Mensagem extends Model
{
    protected $table = 'mensagens';
    
    public function do_usuario(){
        
        //return $this->belongsTo(User::class, 'from_user_id', 'id');
        return $this->belongsTo(Usuario::class, 'do_usuario_id');
        
    }
    
    public function para_usuario(){
        
        return $this->belongsTo(Usuario::class, 'para_usuario_id');
        
    }
    
    public function convite(){
        
        return $this->belongsTo(Convite::class);
        
    }
    
    public function liga(){
        
        //return $this->belongsTo(Liga::class);
        
    }
    
    public static function mensagens(){
        if (auth()->check()){
            return static::where('para_usuario_id', '=', auth()->user()->id)->latest()->get();
        }
        
        return null;
    }
    
    public static function quantidade_mensagens(){
        if (auth()->check()){
            return static::where('para_usuario_id', '=', auth()->user()->id)
                    ->where('lido', '=', FALSE)
                    ->count();
        }
        
        return 0;
    }
    
    public static function mensagem_ler(){
        if (auth()->check()){
            return static::where('para_usuario_id', '=', auth()->user()->id)
                    ->where('lido', '=', FALSE)->get();
        }
        
        return 0;
    }
}
