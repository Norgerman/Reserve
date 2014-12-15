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

    Route::controller("/index", "IndexController");
    Route::controller("/usrreg", "UserregController");
    //Route::controller("/query", "QueryController");
    Route::controller("/hoslist", "HoslistController");
    Route::controller("/deplist","DeplistController");

    Route::get('/', array("uses" => "IndexController@getIndex"));

    Route::get('/register',function(){
        return View::make('index.register',array("type" => "doctor"));
    });

    Route::get("/welcome/{a}/{b?}", array("uses" => "HomeController@showWelcome"));

    Route::get("/slider", function ()
    {
        return View::make('index.slider');
    });


