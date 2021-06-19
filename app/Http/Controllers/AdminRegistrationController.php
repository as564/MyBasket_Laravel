<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
class AdminRegistrationController extends Controller
{
    public function register(){
        return view('admin.register');
    }

    public function postRegister(Request $request){
        
        $user = Sentinel::registerAndActivate($request->all());

        $role = Sentinel::findRoleBySlug('admin');

        $role->users()->attach($user);
        //dd($user);

        return redirect('/');
    }
}
