<?php

namespace App\Http\Controllers;

use App\Module;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginLogoutController extends Controller
{
    public function login()
    {
        $username = request('username');
        $password = request('password');
        $user     = User::whereEmail($username)->first();

        if ( ! $user) {
            return response()->json(['message' => 'Wrong email or password, user'], 422);
        }
        if ( ! Hash::check(request('password'), $user->password)) {
            return response()->json(['message' => 'Wrong email or password, pass'], 422);
        }

        if (request('redirect_url') !== null && request('module') !== null) {
            info("User id=$user->id trying to log in to " . request('module'));
            $module = Module::whereName(request('module'))->first();
            $user->load('orgs');

            foreach ($user->orgs as $org) {
                $org->load('org.subscriptions');
                foreach ($org->org->subscriptions as $subscription) {
                    if ($module->id == $subscription->module_id) {
                        if ($module->valid_till < Carbon::now()) {
                            // TODO: send module expired notifcation
                            info("User id=$user->id org id=$org->id has $module->name but module is expired");
                        }
                        info("User id=$user->id org id=$org->id has $module->name module and is redirected back for token validation");

                        $response = $this->issueToken($user, $username, $password);
                        $data     = json_decode($response->getContent());
                        $url      = env('WORKFORCE_URL');

                        return response()->json([
                            'access_token' => $data->access_token,
                            'url'          => "$url/api/token/validate?access_token=$data->access_token"
                        ]);
                    }
                }
            }

            return response()->json(['message' => 'You do not have this module'], 422);
        }

        info("User id=$user->id trying to log in to Account");

        return $this->issueToken($user, $username, $password);
    }

    /**
     * @param Request $request
     * login to workforce from inside account
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginToWorkforce(Request $request)
    {
        $user = auth()->user();

        info("User id=$user->id trying to log in to WORKFORCE from ACCOUNT");
        $module = Module::whereName('workforce')->first();
        $user->load('orgs');

        foreach ($user->orgs as $org) {
            $org->load('org.subscriptions');
            foreach ($org->org->subscriptions as $subscription) {
                if ($module->id == $subscription->module_id) {
                    if ($module->valid_till < Carbon::now()) {
                        info("User id=$user->id org id=$org->id has $module->name but module is expired");
                    }
                    info("User id=$user->id org id=$org->id has $module->name module and is redirected back for token validation");

                    $url      = env('WORKFORCE_URL');

                    return response()->json([
                        'access_token' => $request->access_token,
                        'url'          => "$url/api/token/validate?access_token=$request->access_token"
                    ]);
                }
            }
        }

        return response()->json(['message' => 'You do not have this module'], 422);
    }

    private function issueToken($user, $username, $password)
    {
        $data = [
            'grant_type'    => 'password',
            'client_id'     => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username'      => $username,
            'password'      => $password,
        ];

        $request  = Request::create('/oauth/token', 'POST', $data);
        $response = app()->handle($request);

        if ($response->getStatusCode() != 200) {
            return response()->json(['message' => 'Wrong email or password, token'], 422);
        }

        $data = json_decode($response->getContent());

        return response()->json([
            'access_token' => $data->access_token,
            'user'         => [
                'fname' => $user->fname,
                'lname' => $user->lname,
                'email' => $user->email
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $userTokens = auth()->user()->tokens;
        foreach ($userTokens as $token) {
            $token->revoke();
        }

        return response()->json(true);
    }
}
