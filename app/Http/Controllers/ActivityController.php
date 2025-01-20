<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function signUpPage(){
        return view('signup');
    }

    public function signUpPost(Request $request){
        dd($request);
    }

    public function loginPage(){
        return view('login');
    }

    public function dealerLogin(){
        return view('dealer_login');
    }
}
