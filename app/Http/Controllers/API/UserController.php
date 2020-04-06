<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'image' => User::storeUserImage($request),
            'national_id' => $request->national_id,
        ]);
        $user->client()->create([
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'mobile' => $request->mobile
        ]);

        auth()->login($user);
        $user->sendEmailVerificationNotification();
        
        return response('A verification email has been sent to your email address');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([   
                'message' => ['Invalid username or password.']
            ], 404);
        }
        $user->client->update(['last_login_at' => now()]);
        $token = $user->createToken('my-app-token')->plainTextToken;
    
        $response = [
            'user' => $user,
            'token' => $token
        ];  
        return response($response, 201);
    }
}
