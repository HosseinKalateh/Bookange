<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\auth\UserRegister;
use App\Http\Requests\auth\UserLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    
    // User Register 
    public function register(UserRegister $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->showOne($user, 201);
    }    

    // User Login
    public function login(UserLogin $request)
    {

        $credentials = $request->only(['email', 'password']);

        $user = Auth::attempt($credentials);

        if ($user) {
            // True Credentials

            $user = User::where('email',$credentials['email'])->first();

            $token = $user->createToken("authunticate")->accessToken;

            return $this->respondWithToken($token, $user);
        } else {
            // Wrong Credentials

            $message = 'Wrong Credentials';
            return $this->showErrorMessage($message, 404);
        }
    }

    // Return Response With Token
    private function respondWithToken($token, $data){

        $user = fractal($data, $data->transformer)->toArray();
        
        return response()->json([
            "user" => $user['data'],
            "token" => $token,
        ],200);
    }

    // User Logout
    public function logout()
    {
        $user = Auth::guard('api')->user()->token();
        $user->revoke();

        $message = 'successfully logged out';
        return $this->showSuccessMessage($message, 200);
    }
}
