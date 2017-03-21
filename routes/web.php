<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

// Route::post('/login', 'Auth\LoginController@authenticate');

Route::get('/account', 'AccountController@show')->name('account');
Route::post('/account/profile/edit', 'AccountController@saveProfile');


