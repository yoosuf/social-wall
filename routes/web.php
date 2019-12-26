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
});






$router->group(['prefix' => 'api/1', 'namespace' => 'Api\V1'], function ($router) {


    $router->group(['namespace' => 'Auth'], function ($router) {

        $router->post('/register', 'RegisterController@createUser');

        $router->post('/login', 'LoginController@authenticate');

    });

    $router->get('/test', 'ExampleController@index');



    $router->group(['namespace' => 'Post'], function ($router) {

        $router->get('/posts', 'PostsController@index');

        $router->post('/posts', 'PostsController@store');

        $router->get('/posts/{post}', 'PostsController@show');

        $router->put('/posts/{post}', 'PostsController@update');

        $router->delete('/posts/{post}', 'PostsController@destroy');

    });


    $router->group(['namespace' => 'Comment'], function ($router) {

        $router->get('/posts/{post}/comments', 'CommentsController@index');

        $router->post('/posts/{post}/comments', 'CommentsController@store');

        $router->get('/posts/{post}/comments/{comment}', 'CommentsController@show');

        $router->put('/posts/{post}/comments/{comment}', 'CommentsController@update');

        $router->delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy');

    });






});



