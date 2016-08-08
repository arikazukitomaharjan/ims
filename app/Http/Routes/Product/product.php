<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/8/16
 * Time: 1:22 PM
 */

Route::group(['prefix' => 'app/v1', 'middleware' => ['auth']], function () {

    //angular route
    Route::get('product', function () {

        return view('admin.product.index');
    });
    Route::get('products', 'ProductController@index');
    Route::post('products/store', 'ProductController@store');

//  Route::get('product','ProductController@store');
    Route::patch('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@delete');
    Route::post('productSale/{id}', 'ProductController@saleProduct');
    Route::post('productByCategory/{id}', 'ProductController@productByCategory');

});