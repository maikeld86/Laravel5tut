<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
    // tijdelijke home pagina
    Route::get('/',function(){
        return 'Home Page';
    });

    Route::get('about','PagesController@about');
    Route::get('contact','PagesController@contact');


    //optimized way to route
    Route::resource('articles','ArticlesController');

    Route::controllers([

        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',

    ]);