<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 6/27/16
     * Time: 12:22 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'app/v1' , 'middleware' => ['auth']] , function () {

        Route::get('expense' , function () {

            /*  $category = Category::remember(1)->get();*/
            return view('admin.expense.index');
        });
        Route::get('expenses' , 'ExpenseController@index');
        Route::post('expenses/store' , 'ExpenseController@store');

        //  Route::get('categories','CategoryController@store');
        Route::patch('expenses/{any}' , 'ExpenseController@update');

        Route::delete('expenses/{any}' , 'ExpenseController@delete');

    });