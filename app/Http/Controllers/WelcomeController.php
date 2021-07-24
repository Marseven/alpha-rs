<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{

    public function index(){
        return view('welcome');
    }

    public function contact(){

        $user = false;
        if(Auth::user()){
            $user = Auth::user();
        }
        return view('contact');
    }

    public function search(Request $request){

    }
}
