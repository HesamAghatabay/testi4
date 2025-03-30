<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if (!$user) {
            return response()->json([
                "status" => "error",
                "message" => "register wring!"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "message" => "register user successfully",
        ], 201);
    }
}
