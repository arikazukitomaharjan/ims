<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 6/8/16
     * Time: 1:17 PM
     */

    use App\Category;
    use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'app/v1' ,'middleware' => ['auth']] , function () {

        /*    Event::listen('illuminate.query', function ($query) {

                var_dump($query);
            });*/

        Route::get('category' , function () {

            /*  $category = Category::remember(1)->get();*/
            return view('admin.categories.index');
        });
        Route::get('categories' , 'CategoryController@index');
        Route::post('categories/store' , 'CategoryController@store');

        //  Route::get('categories','CategoryController@store');
        Route::patch('categories/{any}' , 'CategoryController@update');

        Route::delete('categories/{any}' , 'CategoryController@delete');

    });