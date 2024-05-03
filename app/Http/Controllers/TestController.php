<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth;

use Illuminate\Support\Facades\Auth as LaravelAuth;



class TestController extends Controller
{
   
    private $firebaseAuth;

    public function __construct(Auth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }
    
    public function index()
    {
        return view('test.use');
    }

    public function createUserrr(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:8',
        ]);
    
        // Create a new user in Firebase Authentication
        $userProperties = [
            'email' => $validatedData['email'],
            'emailVerified' => false,
            'password' => $validatedData['password'],
            'displayName' => $validatedData['name'],
        ];
    
        try {
            $createdUser = $this->firebaseAuth->createUser($userProperties);
    
            // User creation successful, you can log the user in or perform additional actions
            LaravelAuth::loginUsingId($createdUser->uid);
    
            return redirect()->route('home')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Handle user creation error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}