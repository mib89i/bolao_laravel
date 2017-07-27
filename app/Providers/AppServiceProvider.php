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

            $notification = \App\Notificacao::messages();
            
            $notification_count = \App\Notificacao::messages_count();

            $view->with(compact('notification', 'notification_count'));
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
