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

//    Route::controller("/reg", "RegisterController");

    Route::controller("/usrreg", "UserregController");



    //Route::controller("/query", "QueryController");



    Route::get('/', array("uses" => "IndexController@getIndex"));

    Route::get('/register',function(){
        return View::make('index.register',array("type" => "user"));
    });

    Route::get("/welcome/{a}/{b?}", array("uses" => "HomeController@showWelcome"));

    Route::get("/slider", function ()
    {
        return View::make('index.slider');
    });

    Route::get("/index", array("uses" => "IndexController@index"));

     Route::get("/detailedhos", array("uses" => "DetailedhospitalController@getIndex"));
