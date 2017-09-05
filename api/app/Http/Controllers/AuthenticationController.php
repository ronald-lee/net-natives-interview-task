<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

/**
 * AuthenticationController
 * Basic implementation of a JWT authentication service
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
class AuthenticationController extends Controller
{
    /**
     * Authenticate the user and return the generated JWT token.
     */
    public function postLogin(Request $request)
    {
        // Get the user specified by the provided email
        if ($user = User::where('email', $request->email)->first()) {
            // Validate the user's credentials by checking the password hash is valid for this user
            $is_authenticated = app('hash')->check($request->password . $user->salt, $user->password_hash);
            if ($is_authenticated === true) {
                // Populate the token public payload
                $public = [
                    'id' => $user->id,
                    'email' => $user->email
                ];
                // Generate and return the token
                $token = $this->generateToken($public);
                return response()->json([
                    'status' => 'success',
                    'token' => $token,
                ]);
            }
        }
        // Return a failure status
        return response()->json([
            'status' => 'fail',
        ]);
    }

    /**
     * Generates a JWT token with some public and private payloads
     */
    private function generateToken($public, $private = null)
    {
        // Populate the token based on https://tools.ietf.org/html/rfc7519
        $token = [
            'iss' => $_SERVER['HTTP_HOST'],
            'aud' => $_SERVER['HTTP_HOST'],
            'iat' => strtotime('now'),
            'exp' => strtotime('+ 1 week'),
            'public' => $public,
            'private' => $private
        ];
        
        // Return the generated token.
        return JWT::encode($token, $_ENV['APP_KEY']);
    }
}
