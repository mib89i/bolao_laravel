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

            $view->with(compact('mensagem', 'quantidade_mensagem'));
            
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
