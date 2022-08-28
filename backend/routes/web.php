<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\EmployeeController;

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
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/login', 'AuthController@login');
    
    $router->group(['prefix' => 'employees'], function () use ($router) {
        $router->get('/index', 'EmployeeController@index');
        $router->post('/create', 'EmployeeController@create');
    });
    $router->group(['prefix' => 'inventory'], function () use ($router) {
        $router->get('/index', 'InventoryController@index');
    });
});
