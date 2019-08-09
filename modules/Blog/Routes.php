<?php

/*
|--------------------------------------------------------------------------
| Web routes for store module
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => config('backend.route'), 'middleware' => ['admin', 'can:backend.view']], function() {
    // Route for datatable ajax query data
    Route::get('/post/datatable', 'BlogController@datatable')->middleware('can:post.view')->name('post.datatable');

    // Route for blog resource: CRUD
    Route::resource('post', 'BlogController');
});