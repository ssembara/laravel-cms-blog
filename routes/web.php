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

    Route::get('/', 'DashboardController@index')
        ->name('dashboard.index');

    Route::get('/portofolios', 'PortofolioController@index')
        ->name('dashboard.portofolio.index');
    Route::get('/portofolio/create', 'PortofolioController@create')
        ->name('dashboard.portofolio.create');
    Route::get('/portofolio/store', 'PortofolioController@store')
        ->name('dashboard.portofolio.store');
    Route::get('/portofolio/{id}/show', 'PortofolioController@show')
        ->name('dashboard.portofolio.show');
    Route::get('/portofolio/{id}/edit', 'PortofolioController@edit')
        ->name('dashboard.portofolio.edit');
    Route::get('/portofolio/update/{id}', 'PortofolioController@update')
        ->name('dashboard.portofolio.update');
    Route::get('/portofolio/destroy/{id}', 'PortofolioController@index')
        ->name('dashboard.portofolio.destory');

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

    Route::get('/profil', 'ProfilController@index')
        ->name('profil.index');
    Route::get('/profil/create', 'ProfilController@create')
        ->name('profil.create');
    Route::get('/profil/store', 'ProfilController@store')
        ->name('profil.store');
    Route::get('/profil/{id}/show', 'ProfilController@show')
        ->name('profil.show');
    Route::get('/profil/{id}/edit', 'ProfilController@edit')
        ->name('profil.edit');
    Route::get('/profil/update/{id}', 'ProfilController@update')
        ->name('profil.update');
    Route::get('/profil/destroy/{id}', 'ProfilController@index')
        ->name('profil.destory');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
