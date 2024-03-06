<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('UserAccessToken')->accessToken;
            return response()->json(['token' => $token]);
        }

        if (Auth::guard('employees')->attempt($credentials)) {
            $employee = Auth::guard('employees')->user();
            $token = $employee->createToken('EmployeeAccessToken')->accessToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    // public function login(Request $request)
    // {


    //     $credentials = request(['email', 'password']);

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $user = $request->user();
    //     $token = $user->createToken('YourAppName')->accessToken;

    //     return response()->json(['token' => $token]);
    // }


}
