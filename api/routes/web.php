<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => '/artisan'], function ($app) {
    $app->post('/db-seed', 'ArtisanController@db_seed');
});

$app->group(['prefix' => '/authentication'], function ($app) {
    $app->post('/', 'AuthenticationController@postLogin');
    // $app->get('/', 'AuthenticationController@getUser');
});

$app->group(['prefix' => '/contacts', 'middleware' => 'auth'], function ($app) {
    $app->get('/', 'ContactsController@search');
});

$app->group(['prefix' => '/contact', 'middleware' => 'auth'], function ($app) {
    $app->post('/', 'ContactsController@store');
    $app->get('/{id}/', 'ContactsController@show');
    $app->put('/{id}', 'ContactsController@update');
    $app->delete('/{id}', 'ContactsController@destroy');
});
