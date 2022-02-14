<?php

namespace App\Http\Controllers\API\Users;

use App\User;
use DataTables;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Create a User controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    /**
     * Register a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:3|confirmed',
                'city' => 'required|min:3|max:255',
                'country' => 'required|min:3|max:255',
                'postcode' => 'required|min:5|max:7',    
            ]
        );

        if ($validator->fails())
        {
            return response()->json([
                "status" => false,
                'message'=>"Please check input values",
                'data' => [],
                'errors' => $validator->errors()->toArray()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'city' => $request->city,
            'country' => $request->country,
            'postcode' => $request->postcode,
        ]);

        
        return response()->json([
            "status" => true,
            'message'=>"Registration Completed!",
            'data' => [],
            'errors' => []
        ], 200);

    }

    /**
     * Login a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:3',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                'message'=>"Please check input values",
                'data' => [],
                'errors' => $validator->errors()->toArray()
            ], 400);
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $id = Auth::guard('web')->id();
            $user = User::where(['id' => $id])->first();

            $user->generateToken();
            
            return response()->json([
                "status" => true,
                'message'=>"Logged in successfully!",
                'data' => $user,
                'errors' => []
            ], 200);

        } else {
            return response()->json([
                "status" => false,
                'message'=>"Incorrect Email or password!",
                'data' => [],
                'errors' => []
            ], 401);            
        }
    }


    public function logout(Request $request)
    {
        $token = $request->header('token');
        
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                'message'=>"Please check input values",
                'data' => [],
                'errors' => $validator->errors()->toArray()
            ], 400);
        }
        
        $user = User::where([
            'email' => $request->email,
            'api_token' => $token
        ])->first();

        
        if ($user) {

            $user->api_token = null;
            $user->save();

            return response()->json(["status" => true,
                    'message'=> "Logged out successfully!",
                    'data' => [],
                    'errors' => []
                ], 200);
        } else {

            return response()->json([
                "status" => false,
                'message'=>"Already Logged out or unauthorize Access!",
                'data' => [],
                'errors' => []
            ], 401);            
        }
    }
}
