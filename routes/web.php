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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::GET('/', 'DashboardController@index')
        ->name('dashboard.index');

    Route::GET('/portofolios', 'PortofolioController@index')
        ->name('portofolio.index');
    Route::GET('/portofolio/create', 'PortofolioController@create')
        ->name('portofolio.create');
    Route::POST('/portofolio/store', 'PortofolioController@store')
        ->name('portofolio.store');
    Route::get('/portofolio/{id}/show', 'PortofolioController@show')
        ->name('portofolio.show');
    Route::GET('/portofolio/{id}/edit', 'PortofolioController@edit')
        ->name('portofolio.edit');
    Route::POST('/portofolio/update/{id}', 'PortofolioController@update')
        ->name('portofolio.update');
    Route::POST('/portofolio/destroy/{id}', 'PortofolioController@destroy')
        ->name('portofolio.destroy');

    Route::get('/options', 'OptionController@index')
        ->name('dashboard.portofolio.index');
    Route::get('/option/create', 'OptionController@create')
        ->name('dashboard.option.create');
    Route::get('/option/store', 'OptionController@store')
        ->name('dashboard.option.store');
    Route::get('/option/{id}/show', 'OptionController@show')
        ->name('dashboard.option.show');
    Route::get('/option/{id}/edit', 'OptionController@edit')
        ->name('dashboard.option.edit');
    Route::get('/option/update/{id}', 'OptionController@update')
        ->name('dashboard.option.update');
    Route::get('/option/destroy/{id}', 'OptionController@index')
        ->name('dashboard.option.destory');

    // Profil
    Route::GET('/profile', 'ProfileController@index')
        ->name('profile.index');
    Route::POST('/profile/update', 'ProfileController@update')
        ->name('profile.update');
    Route::POST('/profile/update-password', 'ProfileController@updatePassword')
        ->name('profile.update.password');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
