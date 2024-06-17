<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Services\LoginService;

class LoginController extends Controller
{

    private $loginService;
    public function __construct(){
        $this->loginService = new LoginService();
    }

    /**
     * Check if Session is exist or not
     *
     * @return [view] 
    */
    public function isLoggedIn(){
        if(Session::get('access_token') !== null){
            // dd(Session::get('user_detail')->id);
            Redirect::to('/dashboard')->send();
        }
        return view('login');
    }

    /**
     * Login Function (/auth/login)
     *
     * @param [string] credential
     * @param [string] password
     * @return 
    */
    public function login(Request $request){
        $user           = $request->get('credential');
        $password       = $request->get('password');

        $resp           = $this->loginService->login($user,$password);
        // dd($resp);
        if ($resp->status) {
            // Token Access
            Session::put('access_token', $resp->data->token);
            Session::put('user_detail', $resp->data->name);
            return redirect('/dashboard');
        }else{
            Session::flash('error', $resp->message);
            return redirect('/');
        }

    }

    public function logout(){
        // flush, save then regenerate to clean old session data
        Session::flush();
        Session::save();
        Session::regenerate(true);
        return redirect('/');
    }

}
