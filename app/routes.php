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
    Route::controller("/doclist","DoclistController");
    Route::controller("/admin","AdminController");
    Route::controller("/deplist","DeplistController");

    Route::get('/', array("uses" => "IndexController@getIndex"));

    Route::get('/hospital',function(){
        return View::make('hoslist.index');
    });

    Route::get('/getorder',function(){
        return View::make('getord.index');
    });

    Route::get("/welcome/{a}/{b?}", array("uses" => "HomeController@showWelcome"));

    Route::get("/slider", function ()
    {
        return View::make('index.slider');
    });

Route::get('/question',function(){
    return View::make('question.index');
});
