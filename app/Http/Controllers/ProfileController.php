<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        $user        = auth()->user();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->update();

        info("User id=$user->id updated own profile");

        return response()->json(['message' => 'Profile Updated']);
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user           = auth()->user();
        $user->password = Hash::make($request->password);
        $user->update();

        info("User id=$user->id updated own password");

        return response()->json(['message' => 'Password Updated']);
    }
}
