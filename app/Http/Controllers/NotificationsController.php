<?php

namespace App\Http\Controllers;

use App\Notificacao;

class NotificationsController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth')->except([]);

    }
    
    public function index(){
        
        $notification_to_read = Notificacao::messages_to_read();
        
        foreach($notification_to_read as $not){
            $not->readed = TRUE;
            
            $not->update();
        }
        
        $notifications = Notification::messages();
        
        return view ('notifications.index', compact('notifications'));
    }
}
