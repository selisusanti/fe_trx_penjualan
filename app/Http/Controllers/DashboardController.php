<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class DashboardController extends Controller
{
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
    public function dashboard(){
        return view('dashboard');
    }

}
