<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',         'HomeController@index')->name('index');
Route::get('/home',     'HomeController@home')->name('home');
Route::get('/roles',    'HomeController@roles');
Route::get('/home',     'HomeController@admin');
Route::get('/logout',   'Auth\LoginController@logout');

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
