<?php

namespace App\Http\Controllers;

use Socialite;
use App\Usuario;

class LoginController extends Controller {

    public function __construct() {

        //$this->middleware('auth')->except(['index', 'login']);
    }

    public function redirectToProvider() {
        //return Socialite::driver('facebook')->redirect();
        
        return Socialite::driver('facebook')->scopes([
            //'user_birthday'
        ])->redirect();
    }

    public function handleProviderCallback() {
        try {
            //$social_user = Socialite::driver('facebook')->user();
            $social_user = Socialite::driver('facebook')->fields([
                'name', 'email', 'gender', 'birthday', 'link', 'id'
            ])->user();
            
        } catch (\Exception $ex) {
            return redirect()->route('login');
        }


        $user = Usuario::where('facebook_id', $social_user->id)->first();
        
        
        if (!$user) {
            
            $user = Usuario::create([
                        'facebook_id' => $social_user->id,
                        'apelido' => $social_user->nickname,
                        'avatar' => $social_user->avatar,
                        'avatar_original' => $social_user->avatar_original,
                        'genero' => '',//$social_user->user['gender'], -- EXIGE HTTPS
                        'link' => '',//$social_user->user['link'], -- EXIGE HTTPS
                        'nome' => $social_user->name,
                        'email' => $social_user->email,
            ]);
            
            //return dd($user);
        }

        auth()->login($user);

        return redirect('/');
        
    }

    public function logout() {
        session()->flush();
        
        auth()->logout();

        return redirect('/');
    }

}
