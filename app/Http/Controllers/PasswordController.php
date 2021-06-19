<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Sentinel;

class PasswordController extends Controller
{
    public function edit(){
        return view('admin.reset-password');
    }

    public function update(){
        $hasher = Sentinel::getHasher();

        $oldPassword = Input::get('old_password');
        $password = Input::get('password');
        $passwordConf = Input::get('password_confirmation');

        $user = Sentinel::getUser();

        if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
            Session::flash('error', 'Check input is correct.');
            return view('admin.reset-password');
        }

        Sentinel::update($user, array('password' => $password));

        return Redirect::to('/');
    }
}
