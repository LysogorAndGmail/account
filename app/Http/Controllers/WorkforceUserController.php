<?php

namespace App\Http\Controllers;

use App\OrgUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkforceUserController extends Controller
{
    public function create(Request $request)
    {
        info("Starting to create user from WORKFORCE");
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            info("User exist id=$existingUser->id");

            $orgUser          = new OrgUser();
            $orgUser->org_id  = $request->org_id;
            $orgUser->user_id = $existingUser->id;
            $orgUser->role    = 'user';
            $orgUser->save();

            info("User id=$existingUser->id linked to org id=$orgUser->id");

            return response()->json($existingUser);
        }
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = new User([
            'fname'    => $request->fname,
            'lname'    => $request->lname,
            'email'    => $request->email,
            'password' => Hash::make('secret'),
            'ip'       => $request->ip()
        ]);
        $user->save();

        info("User did not exist, create new id=$user->id");

        //TODO: send invitation link

        $orgUser          = new OrgUser();
        $orgUser->org_id  = $request->org_id;
        $orgUser->user_id = $user->id;
        $orgUser->role    = 'user';
        $orgUser->save();

        info("User id=$user->id linked to org id=$orgUser->id");

        return response()->json($user);
    }

    public function update(Request $request)
    {
        info("Starting to update user from WORKFORCE");

        $user = User::find($request->id);

        if ($user) {
            info("User exist id=$user->id");

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->update();

            info("User id=$user->id updated from WORKFORCE");

            return response()->json(true);
        }

        return response()->json(false);
    }

    public function destroy(Request $request)
    {
        info("Starting to delete user from WORKFORCE");

        $user = User::find($request->id);

        if ($user) {
            info("User id=$user->id deleted from WORKFORCE from org id=$request->org_id");

            $orgUser = OrgUser::where('org_id', $request->org_id)->where('user_id', $user->id)->delete();

            info("User id=$user->id deleted from WORKFORCE");

            $user->delete();

            return response()->json(true);
        }

        return response()->json(false);
    }
}
