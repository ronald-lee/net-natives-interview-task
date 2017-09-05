<?php

namespace App\Providers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            try {
                // Extract the JWT token from the Request Authorization header
                $token = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $token);

                // Check that the token string is not empty, otherwise JWT::decode will throw an Exception
                if ($token !== '') {
                    // Decode the JWT token to obtain the user id
                    $decoded_token = JWT::decode($token, $_ENV['APP_KEY'], array('HS256'));
                    $id = $decoded_token->public->id;
                    // Return the user specified by $id
                    return User::find($id);
                }
            } catch (Exception $e) {
                // TODO: Do something when the authentication has failed.
            }
        });
    }
}
