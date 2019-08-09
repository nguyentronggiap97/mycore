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
    # Campaign datatable ajax
    Route::get('/menu/ajax',   'MenuController@ajax')
        ->middleware('can:menu.view')
        ->name('menu.ajax');
    Route::resource('menu',    'MenuController');
});