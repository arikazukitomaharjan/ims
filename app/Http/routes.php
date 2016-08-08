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

    Route::get('/' , function () {

        return view('auth.login');
    });

    //
    //Route::get('welcome',function(){
    //    return view('admin.dashboard');
    //});

    Route::group(['prefix' => 'app/v1' , 'middleware' => ['auth']] , function () {

        Route::get('/home' , 'HomeController@index');
        Route::get('dashboard' , 'DashboardController@index');
    });

    $router->group(['namespace' => 'Category'] , function () use ($router) {

        require(__DIR__ . '/Routes/Category/category.php');
    });

    $router->group(['namespace' => 'Product'] , function () use ($router) {

        require(__DIR__ . '/Routes/Product/product.php');
    });

    $router->group(['namespace' => 'Sale'] , function () use ($router) {

        require(__DIR__ . '/Routes/Sale/sale.php');
    });

    $router->group(['namespace' => 'Expense'] , function () use ($router) {

        require(__DIR__ . '/Routes/Expense/expense.php');
    });

    $router->group(['namespace' => 'User'] , function () use ($router) {

        require(__DIR__ . '/Routes/User/user.php');
    });

    Route::auth();

