<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {   
        $user = new User;
        return view('frontend.login.forgotpassword',compact('user'));
    }

    public function forgotPasswordpost(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email','exists:users'],
        ]);

        $token= Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request-> email,
            'token' => $token,
            'created_at'=>Carbon::now()
           
        ]);

        // Mail::send("emails.forgot-password",['token'=>$token],function ($message) use ($request){
        //     $message->to($request->)
        // });
      
    }

    public function resetPassword(){
        
    }
   
}
