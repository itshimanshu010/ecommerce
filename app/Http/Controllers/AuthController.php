<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {   
        
        return view('login.register');
    }
   
    public function register(Request $request)
    {
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }



    public function showUserLoginForm()
    {   
        $user = new User;
        return view('login.signin',compact('user'));
    }

    public function userlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
           
            return redirect()->route('home');
        } else {
            
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(){
        \Session::flash("message', 'You have been logged out successfully.");
        \Auth::logout();
        return redirect("");


    }

    public function userDashboard(){
        return view('frontend.user.dashboard');


    }



   
    
}
