<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (Request $request)
    {
       $credentials = $request->validate([
           'email' => 'required|email',
           'password' => 'required|string|min:6'
       ]);

         if (!Auth::attempt($credentials)) {
              return response()->json(['message' => 'Invalid credentials'], 401);
         }

        $user = Auth::user();
        $company = $user->company;

        if(!$company){
            return response()->json(['message' => 'No company associated with this user'], 404);
        }
        
        $company->load('user');

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'data' => $company
        ], 200);
    }
}
