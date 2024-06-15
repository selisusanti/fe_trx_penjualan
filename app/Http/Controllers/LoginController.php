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
            return redirect('/dashboard');
        }else{
            Session::flash('error', $resp->message);
            return redirect('/');
        }

    }

}
