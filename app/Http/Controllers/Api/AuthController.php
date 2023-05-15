<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
// use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api,web', ['except' => ['login', 'register']]);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        if(!$token = auth()->attempt($validator->validate())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $request->user()->createToken('token');

        return $this->userdata_with_token($token->plainTextToken);

    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
            'phone' =>'required|numeric|digits:11',
            'national_id' =>'required|numeric|digits:14',
            'city' =>'required|string|max:20',
            'gender' =>'required|string|max:7',
            'age' =>'required|numeric|digits:2',
            'deposite' =>'required|numeric',
            
        ]);
        $account_number="4";
        for($i=0;$i<13;$i++){
        $account_number.=rand(0,9);
        } 


        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson(),400);
        }
        

        $user = User::create(array_merge(
            $validator->validated(),
        ['password' => Hash::make($request->password),'confirm_password' => Hash::make($request->confirm_password),
        'account_number'=>$account_number,
        ]
        ));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ],201);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }



    public function userdata_with_token($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth()->user()
        ]);
    }

}
