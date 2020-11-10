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

$router->get('/', function () use ($router) {
    // return $router->app->version();
    $users = App\User::all()->toJson();

    echo $users;

});

$router->group(['middleware' => ['cors', 'auth'],'prefix' => 'api'], function () use ($router)
{
    $router->get('profile', 'AuthController@profile');
    $router->get('logout', 'AuthController@logout');
    $router->get('assets', 'AssetController@index');
    $router->get('asset/search', 'AssetController@search');
    $router->get('assets/filter','AssetController@filter');
    $router->get('assets/sort', 'AssetController@sort');
    $router->get('asset/{id}', 'AssetController@show');
    $router->get('reservations', 'ReservationController@index');
    $router->post('reservations', 'ReservationController@create');
    $router->get('reservations/{id}', 'ReservationController@read');
    $router->put('reservations/{id}', 'ReservationController@update');
});

$router->group(['middleware' => 'cors', 'prefix' => 'api'], function () use ($router)
{
    $router->post('register/lecturer', 'AuthController@registerLecturer');
    $router->post('register/student', 'AuthController@registerStudent');
    $router->post('login', 'AuthController@login');
});

// Use this route for generate key and paste it to APP_KEY .env (Development only)
// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });
