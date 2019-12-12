<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;

class TokenValidatorController extends Controller
{
    protected $server;
    protected $tokens;

    public function __construct(ResourceServer $server, TokenRepository $tokens)
    {
        $this->server = $server;
        $this->tokens = $tokens;
    }

    public function validateAuthorization(Request $request)
    {
        info("Starting to validate token");
        info("Request is $request");

        $psr = (new DiactorosFactory)->createRequest($request);

        try {
            $psr   = $this->server->validateAuthenticatedRequest($psr);
            $token = $this->tokens->find($psr->getAttribute('oauth_access_token_id'));

            info("Trying to validate token id=$token->id");
            if (Carbon::parse($token->expires_at) < Carbon::now()) {
                return response()->json(['message' => 'Token Expired'], 401);
            }
            info("Token is valid and belongs to user_id=$token->user_id");

            return response()->json([
                'user_id' => $token->user_id,
                'granted' => true
            ]);
        } catch (OAuthServerException $e) {
            return response()->json(['message' => 'Unauthorized, OAuth Server Exception'], 401);
        }
    }
}
