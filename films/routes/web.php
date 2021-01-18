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
$router->group(['middleware' => 'token'], function () use ($router) {
    $router->get('/movies/all','FilmsController@index');
    $router->get('/movies/{year}','FilmsController@moviesByYear');
    $router->get('/movies/actor/{id}','FilmsController@moviesByActor');
    $router->post('/movie/create','FilmsController@store');
    $router->get('/movie/read/{id}','FilmsController@show');
    $router->put('/movie/update/{id}','FilmsController@update');
    $router->delete('/movie/delete/{id}','FilmsController@delete');
});
