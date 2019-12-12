<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser()
    {
        return response()->json([
            'user' => [
                'fname' => auth()->user()->fname,
                'lname' => auth()->user()->lname,
                'email' => auth()->user()->email
            ]
        ]);
    }
}
