<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuarios';
    
    protected $fillable = [
        'nome', 'email', 'senha', 'facebook_id', 'genero', 'avatar', 'avatar_original', 'link', 'apelido', 
    ];

    protected $hidden = [
        'senha', 'remember_token',
    ];
    
    
    public function setPasswordAttribute($password) {

        $this->attributes['senha'] = bcrypt($password);
        
    }
}
