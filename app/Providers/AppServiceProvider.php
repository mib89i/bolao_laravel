<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        
        \Carbon\Carbon::setLocale('pt_BR');
        
        view()->composer('layouts.nav', function($view) {

            $mensagem = \App\Mensagem::mensagens();
            
            $quantidade_mensagem = \App\Mensagem::quantidade_mensagens();
            
            $temporada_ativa = \App\Temporada::ativa()->limit(1)->first();
            
            session()->put('temporada_ativa', $temporada_ativa);
            
            $view->with(compact('mensagem', 'quantidade_mensagem', 'temporada_ativa'));
            
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
