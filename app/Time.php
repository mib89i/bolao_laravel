<?php

namespace App;

class Time extends Model
{
    protected $table = 'times';
    
    public static function pesquisa_times($nome){
        return static::whereRaw('lower(translate(nome)) like lower(translate(' . '\'%' . $nome . '%\'' . '))')
                    ->limit('5')
                    ->get();
    }
}
