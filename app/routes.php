<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Route::get('/', function ()
    {
        return View::make('index.index', array("login" => "false"));
    });

    Route::get('/register',function(){
        return View::make('index.register');
    });

    Route::get("/welcome/{a}/{b?}", array("uses" => "HomeController@showWelcome"));

    Route::get("/slider", function ()
    {
        return View::make('index.slider');
    });

    Route::get("/index", array("uses" => "IndexController@index"));
