<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserFireController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'users';
    }

    public function index()
    {
         return view('test.use');
    }

    public function saveUser(Request $request){

        
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

           
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        
            $hashedPassword = Hash::make($request->password);

         
            $postData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
            ];

            
            $ref_tablename = 'users'; 
            $postRef =  $this->database->getReference($ref_tablename)->push($postData);

           
            if($postRef){
                return redirect('FirebaseUsers')->with('status','User added successfully');
            } else {
                return redirect('FirebaseUsers')->with('status','Failed to add user');
            }
    }
}
