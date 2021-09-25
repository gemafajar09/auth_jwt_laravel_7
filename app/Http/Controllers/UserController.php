<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\UserModel;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (! $token = Auth::guard('users_jwt')->attempt(['email' => $request->email,'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->reponToken($token);
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $password = password_hash($request->password,PASSWORD_DEFAULT);
        $save = UserModel::register($email,$name,$password);
        return response()->json(['pesan' => $save]);
    }

    public function me()
    {
        return response()->json(Auth::guard('users_jwt')->user());
    }

    public function logout()
    {
        Auth::guard('users_jwt')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function reponToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'data' => Auth::guard('users_jwt')->user()
        ]);
    }
}
