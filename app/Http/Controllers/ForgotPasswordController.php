<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        return view('admin.forgot-password');
    }

    public function postForgotPassword(Request $request){
       
        
        $user = User::whereEmail($request->email)->first();
        
       //$user  = Sentinel::findByCredentials(['email' => $email]);
        

        if($user){
            $sentinelUser = Sentinel::findById($user->id);
          
            // return redirect()->back()->with([
            //     'success' => 'Reset code was sent to your email.'
            // ]);

        $reminder = Reminder::exists($sentinelUser) ?: Reminder::create($sentinelUser);
        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with([
            'success' => 'Reset code was sent to your email.'
            ]);
        }
        else{
            return redirect()->back()->with([
                'error' => 'User does not exist.'
                ]);
        }


    }

    private function sendEmail($user, $code){
       
        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);

            $message->subject("Hello $user->first_name, reset your password.");
        }
    );

    }

    public function resetPassword($email, $resetCode) {
        
        $user = User::byEmail($email);
        
        if($user == null){
            abort(404);
        }else {
            $sentinelUser = Sentinel::findById($user->id);

            if($reminder = Reminder::exists($sentinelUser)){
                if($resetCode == $reminder->code){
                    return view('admin.forgot-reset-password');
                }
                else{
                    return redirect('/');
                }
            }else {
                return redirect('/');
            }
            
        }
    }

    public function postResetPassword(Request $request, $email, $resetCode){

        $this->validate($request, [
            'password' => 'confirmed|required|min:5|max:10',
            'password_confirmation' => 'required|min:5|max:10',
        ]);
        $user = User::byEmail($email);
        
        if($user == null){
            abort(404);
        }else {
            $sentinelUser = Sentinel::findById($user->id);

            if($reminder = Reminder::exists($sentinelUser)){
                if($resetCode == $reminder->code){
                    Reminder::complete($sentinelUser, $resetCode, $request->password);
                    return redirect('/')->with('success', 'Please login with your new password');
                }
                else{
                    return redirect('/');
                }
            }else {
                return redirect('/');
            }
            
        }
    }
}

