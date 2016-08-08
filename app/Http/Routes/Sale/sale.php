<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 6/8/16
     * Time: 1:22 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'app/v1' , 'middleware' => ['auth']] , function () {

        //angular route
        Route::get('sale' , function () {

            return view('admin.sales.index');
        });

        Route::get('sales' , 'SaleController@index');
        Route::post('saleRange' , 'SaleController@saleRange');
        Route::delete('sales/{id}' , 'SaleController@delete');

    });