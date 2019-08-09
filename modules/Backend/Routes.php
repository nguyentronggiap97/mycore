<?php

/*
|--------------------------------------------------------------------------
| Web routes for backend module
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => config('backend.route'), 'middleware' => ['admin', 'can:backend.view']], function() {
    # Dashboard route
    Route::get('/', 'DashboardController@index')->name('admin.index');

    # Team datatable ajax
    Route::get('/users/ajax',               'UserController@ajax')->name('users.ajax');
    Route::get('/users/search',             'UserController@search')->name('users.search');
    Route::any('/users/{user}/password',    'UserController@password')->middleware('can:user.password')->name('users.password');
    Route::get('/settings/ajax',            'SettingController@ajax')->name('setting.ajax');
    Route::get('/terms/search',             'TermController@search')->name('terms.search');
    Route::get('/ajax/search',              'AjaxController@search')->name('ajax.search');

    # Team resource routes
    Route::resource('users',                'UserController');
    Route::resource('roles',                'RoleController');
    Route::resource('perms',                'PermController');
    Route::resource('settings',             'SettingController');
});