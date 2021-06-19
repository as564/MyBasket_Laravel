<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
class AdminLoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        
        if(Sentinel::authenticate($request->all())){
            $slug = Sentinel::getUser()->roles()->first()->slug;
            //return Sentinel::check();
            return redirect('/admin-dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Wrong Credentials']);
        }
        

        
    }

    public function logout(){
        Sentinel::logout();

        return redirect('/');
    }
}
