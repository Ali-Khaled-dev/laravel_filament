<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller 
{

  use ApiResponseTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
   


    public function login(Request $request)
    {
       
        $user = $request->only('email','password');
    
            if(!$user){
                return $this->apiResponse(null,'Unauthorized ',404);
        
                }
              return $this->apiResponse($user,'User successfully registered',201);
            }

    public function register(UserRequest $request) {
       
        $user = User::create([

            'name'  => $request -> name,
            'email' => $request -> email,
            'password' => $request -> password,
            
        ]);

         $token = JWTAuth::fromUser($user);

         return $this -> apiResponse($token, 'User successfully registered', 201);
    
    }

   
    public function logout() 
    {
    
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
  
    }
  
   
    
    public function userProfile() 
    {
        return response()->json(auth()->user());
    }
   
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }
}