<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use GuzzleHttp\Promise\Create;
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
        $profile = Profile::create(['full_name' => 'Test', 'user_id' => $user->id]);
        // $user->profile()->save($profile);
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

    function sendverify(Request $request)
    {
        $code = rand(1000, 9999);
        if ($user = User::where('mobile', $request->mobile)->first()) {
            $user->password = Hash::make($code);
            $user->save();
            // return response()->json(['status' => true, 'message' => 'user alredy exist'], 400);
        } else {
            $user = User::create([
                'name' => '',
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => Hash::make($code),
            ]);
            $profile = Profile::create(['full_name' => 'Test', 'user_id' => $user->id]);
        }
        $user->sendVerifyCode($code, $request->mobile);
        // if (!$user->sendVerifyCode($code, $request->mobile)) {
        //     return response()->json(['status' => false, 'message' => 'error in Send Verify Code'], 400);
        // } else {
        //     return response()->json(['status' => true], 201);
        // }

    }

}
