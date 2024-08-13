<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($validated))
        {   
            return GlobalHelper::response([
                'status' => 'error',
                'message' => 'Invalid username or password',
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();

        return GlobalHelper::response([
            'user_id' => Auth::id(),
            'user_type' => $user['user_type'],
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        
        $user = User::create($validated);
        
        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ], 201);
    }
}