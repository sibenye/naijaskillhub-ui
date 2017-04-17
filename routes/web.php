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
Route::get('/account/dashboard', 'Account\DashboardController@show')->name('dashboard');
Route::get('/account/profile/edit', 'Account\ProfileController@show')->name('edit-profile');
Route::get('/account/portfolio/images', 'Account\PortfolioController@showImages')->name(
        'edit-portfolio-images');
Route::get('/account/portfolio/audios', 'Account\PortfolioController@showAudios')->name(
        'edit-portfolio-audios');
Route::get('/account/portfolio/image/add', 'Account\PortfolioController@addPortfolioImage')->name(
        'add-portfolio-image');
Route::get('/account/portfolio/image/edit/{imageId}',
        'Account\PortfolioController@editPortfolioImage')->name('edit-portfolio-image');
Route::get('/account/portfolio/audio/add', 'Account\DashboardController@addPortfolioAudio')->name(
        'add-portfolio-audio');
Route::get('/account/portfolio/audio/edit/{audioId}',
        'Account\PortfolioController@editPortfolioAudio')->name('edit-portfolio-audio');

Route::post('/account/profile/edit', 'Account\ProfileController@saveProfile');
Route::post('/account/profile/image/upload', 'Account\ProfileController@saveProfileImage');
Route::post('/account/portfolio/image/upload', 'Account\PortfolioController@savePortfolioImage')->name(
        'save-portfolio-image');
Route::post('/account/portfolio/image/update', 'Account\PortfolioController@updatePortfolioImage')->name(
        'update-portfolio-image');
Route::post('/account/portfolio/audio/upload', 'Account\PortfolioController@savePortfolioAudio')->name(
        'save-portfolio-audio');
Route::post('/account/portfolio/audio/update', 'Account\PortfolioController@updatePortfolioAudio')->name(
        'update-portfolio-audio');

Route::delete('/account/portfolio/image', 'Account\PortfolioController@deletePortfolioImage');
Route::delete('/account/portfolio/audio', 'Account\PortfolioController@deletePortfolioAudio');



