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

    // public function saveUser(Request $request){

        
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|string|email|max:255|unique:users',
    //             'password' => 'required|string|min:8|confirmed',
    //         ]);

           
    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

        
    //         $hashedPassword = Hash::make($request->password);

         
    //         $postData = [
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => $hashedPassword,
    //         ];

            
    //         $ref_tablename = 'users'; 
    //         $postRef =  $this->database->getReference($ref_tablename)->push($postData);

           
    //         if($postRef){
    //             return redirect('FirebaseUsers')->with('status','User added successfully');
    //         } else {
    //             return redirect('FirebaseUsers')->with('status','Failed to add user');
    //         }
    // }

    public function saveUser(Request $request) {

        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Hash the password
        $hashedPassword = Hash::make($request->password);
    
        // Construct user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
        ];
    
        // Get reference to the 'users' node in Firebase
        $refTableName = 'users'; 
        $usersRef = $this->database->getReference($refTableName);
    
        // Check if the email already exists
        $existingUser = $usersRef->orderByChild('email')->equalTo($request->email)->getSnapshot()->getValue();
    
        // If email already exists, return with error message
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'The email has already been taken.'])->withInput();
        }
    
        // Push user data to Firebase
        $postRef = $usersRef->push($userData);
    
        // Check if user data is successfully added
        if ($postRef) {
            return redirect('FirebaseUsers')->with('status', 'User added successfully');
        } else {
            return redirect('FirebaseUsers')->with('status', 'Failed to add user');
        }
    }

    public function pushNotification()
	{

	        $data=[];
	        $data['message']= "Some message";

	        $data['booking_id']="my booking booking_id";
	        
            $tokens = [];
            $tokens[] = 'YOUR_TOKEN';
	        $response = $this->sendFirebasePush($tokens,$data);

	}


    public function sendFirebasePush($tokens, $data)
	{

	        $serverKey = 'YOUR_SERVER_KEY_HERE';
	        
	        // prep the bundle
	        $msg = array
	        (
	            'message'   => $data['message'],
	            'booking_id' => $data['booking_id'],
	        );

	        $notifyData = [
                 "body" => $data['message'],
                 "title"=> "Port App"
            ];

	        $registrationIds = $tokens;
	        
	        if(count($tokens) > 1){
                $fields = array
                (
                    'registration_ids' => $registrationIds, //  for  multiple users
                    'notification'  => $notifyData,
                    'data'=> $msg,
                    'priority'=> 'high'
                );
            }
            else{
                
                $fields = array
                (
                    'to' => $registrationIds[0], //  for  only one users
                    'notification'  => $notifyData,
                    'data'=> $msg,
                    'priority'=> 'high'
                );
            }
	            
	        $headers[] = 'Content-Type: application/json';
	        $headers[] = 'Authorization: key='. $serverKey;

	        $ch = curl_init();
	        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	        curl_setopt( $ch,CURLOPT_POST, true );
	        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	        // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	        $result = curl_exec($ch );
	        if ($result === FALSE) 
	        {
	            die('FCM Send Error: ' . curl_error($ch));
	        }
	        curl_close( $ch );
	        return $result;
	}
    
}
