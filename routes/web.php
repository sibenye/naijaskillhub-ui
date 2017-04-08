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

// Account route
Route::get('/account/dashboard', 'Account\DashboardController@show')->name('account');
Route::get('/account/dashboard/portfolio/image/add',
        'Account\DashboardController@addPortfolioImage')->name('add-portfolio-image');
Route::get('/account/dashboard/portfolio/image/edit/{imageId}',
        'Account\DashboardController@editPortfolioImage')->name('edit-portfolio-image');

Route::post('/account/dashboard/profile/edit', 'Account\DashboardController@saveProfile');
Route::post('/account/dashboard/profile/image/upload',
        'Account\DashboardController@saveProfileImage');
Route::post('/account/dashboard/portfolio/image/upload',
        'Account\DashboardController@savePortfolioImage')->name('save-portfolio-image');
Route::post('/account/dashboard/portfolio/image/update',
        'Account\DashboardController@updatePortfolioImage')->name('update-portfolio-image');



