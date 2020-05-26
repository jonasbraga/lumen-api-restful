<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

/**
 * Controller name must be singular, as model does.
 */

$router->group(['prefix' => 'api/cars'], function () use ($router) {
    $router->get('/', "CarController@getAll");
    $router->get('/{id}', "CarController@get");
    $router->post('/', "CarController@store");
    $router->put('/{id}', "CarController@update");
    $router->delete('/{id}', "CarController@destroy");
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
