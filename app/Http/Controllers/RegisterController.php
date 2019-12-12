<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fname'    => ['required', 'string', 'max:255'],
            'lname'    => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = new User([
            'fname'    => $request->fname,
            'lname'    => $request->lname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'ip'       => $request->ip()
        ]);
        $user->save();

        return response()->json(['message' => 'User Created']);
    }
}
