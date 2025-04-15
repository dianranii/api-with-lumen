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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/Student', 'studentController@index');
$router->get('/Student/{id}', 'Studentcontroller@read');
$router->post('/Student', 'studentController@create');
$router->put('/Student/{id}', 'studentController@update');
$router->delete('/Student/{id}', 'studentController@delete');