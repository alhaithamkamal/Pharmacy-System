<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $request->validate(['email' => 'required|email|unique:users', 'image' => 'required']);
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

    public function update(UserRequest $request, User $user)
    {
        $userAttributes = [
            'name' => $request->name,
            'password' => $request->password,
            'national_id' => $request->national_id,
        ];
        if ($request->hasFile('image')){
            $userAttributes['image'] = User::storeUserImage($request);
            Storage::delete('public/'.$user->image);
        }
        $clientAttributes = [
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'mobile' => $request->mobile
        ];

        $user->update($userAttributes);
        $user->client->update($clientAttributes);
        return response('Your profile info has been updatd');
    }
    public function show(User $user)
    {
        return $user;
    }
}
