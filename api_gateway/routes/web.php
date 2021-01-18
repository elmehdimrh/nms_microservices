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

$router->post('/token','AccessController@retrieveToken');

$router->group(['middleware' => 'token'], function () use ($router) {

    $router->get('/acteurs','ActeursController@index');
    $router->get('/acteur/details/{id}','ActeursController@show');
    $router->post('/acteur/ajouter','ActeursController@store');
    $router->put('/acteur/modifier/{id}','ActeursController@update');
    $router->delete('/acteur/supprimer/{id}','ActeursController@delete');


    $router->get('/films','FilmsController@index');
    $router->post('/film/ajouter','FilmsController@store');
    $router->get('/film/details/{id}','FilmsController@show');
    $router->put('/film/modifier/{id}','FilmsController@update');
    $router->delete('/film/supprimer/{id}','FilmsController@delete');
    $router->get('/films/{annee}','FilmsController@filmsByYear');
    $router->get('/acteur/{id}/films','FilmsController@actorFilms');
});

