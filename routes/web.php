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
    return $router->app->version();
    // $users = App\User::all()->toJson();

    // echo $users;

});

$router->group(['middleware' => ['auth', 'lecturer'],'prefix' => 'api'], function () use ($router)
{
    $router->post('asset', 'AssetController@store');
    $router->post('asset/{id}', 'AssetController@update');
    $router->delete('asset/{id}', 'AssetController@destroy');
    $router->get('reservations', 'ReservationController@indexLecturer');
    $router->get('reservations/count', 'ReservationController@getCountReservation');
    $router->put('reservations/{id}', 'ReservationController@update');
});

$router->group(['middleware' => ['auth', 'student'],'prefix' => 'api'], function () use ($router)
{
    $router->get('reservations/student', 'ReservationController@indexStudent');
    $router->get('reservations/student/count', 'ReservationController@getCountStudentReservation');
    $router->post('reservations', 'ReservationController@create');
});

$router->group(['middleware' => 'auth','prefix' => 'api'], function () use ($router)
{
    $router->get('profile', 'AuthController@profile');
    $router->get('logout', 'AuthController@logout');
    $router->get('assets', 'AssetController@index');
    $router->get('asset/search', 'AssetController@search');
    $router->get('assets/sort', 'AssetController@sort');
    $router->get('asset/{id}', 'AssetController@show');
    $router->get('reservations/search', 'ReservationController@search');
    $router->post('reservation/request/{id}', 'ReservationController@assetRequest');
    $router->get('reservations/{id}', 'ReservationController@read');
});

$router->group(['prefix' => 'api'], function () use ($router)
{
    $router->post('register/lecturer', 'AuthController@registerLecturer');
    $router->post('register/student', 'AuthController@registerStudent');
    $router->post('login', 'AuthController@login');
});

// Use this route for generate key and paste it to APP_KEY .env (Development only)
// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });
