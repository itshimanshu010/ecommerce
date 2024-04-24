<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            $response = [
                'status' => 0,
                'message'=>'user not found'
            ];
        }
        else{
            $response = [
                'status' => 1,
                'message'=>'user found',
                'user' => $user
            ];
        }
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $users = User::all();

        if(count($users)>0){
            $response = [
                'message' => count($users) . " users found",
                'status' => 1,
                'user' => $users
            ];

            return response()->json($response,200);
      }
        else{
            $response = [
                'message' => count($users) . "users found",
                'status' => 0,
               
            ];

            return response()->json($response,200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'phone' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:active,inactive'], 
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first(),
            ]);
        }
        else{
            $data = [
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
                'phone'=> $request->phone,
            ];
         
            DB::beginTransaction();

            try {
                $user=User::create($data);
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                p($e->getMessage());
                $user = null;
            }

            if($user != null){
                return response()->json([
                    'status' => 1,
                    'message'=>'user registerd successfully',
                    'user' => $user
                ],200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>'internal server error'
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);

        if(is_null($user)){
            return response()->json([
                'status' => 0,
                'message' => 'User not found'
            ], 404);
        }

        else{
            DB::beginTransaction();

            try{
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->phone = $request['phone'];
               
                $user->save();
                DB::commit();
            }catch(\Exception $err){
                DB::rollBack();
                $user = null;

            }
            if(is_null($user)){
                return response()->json(
                    [
                    'status' => 0,
                    'message'=>'internal server error',
                    'error_msg' => $err->getMessage()
                    ],
                    500
                );
            }
            else{
                return response()->json(
                    [
                        'status' => 1,
                        'message'=>'user updated successfully',
                        'user' => $user
                    ],200
                );
            }
        }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'User not found'], 404);
        }
    
        $user->delete();
    
        return response()->json([
            'status' => 1,
            'message' => 'User deleted successfully']);
    }
}
