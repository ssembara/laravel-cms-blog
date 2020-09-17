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

use Illuminate\Support\Facades\Route;

Route::get('/', 'OptionController@content')->name('content');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::GET('/', 'DashboardController@index')
        ->name('dashboard.index');

    // Blog
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

    // Option
    Route::get('/options', 'OptionController@index')
        ->name('option.index');
    Route::post('/option/update/{id}/greeting', 'OptionController@greeting')
        ->name('option.greeting.update');
    Route::post('/option/update/{id}/skill', 'OptionController@skill')
        ->name('option.skill.update');
    Route::post('/option/update/{id}/aboutme', 'OptionController@aboutMe')
        ->name('option.aboutme.update');
    Route::post('/option/update/{id}/location', 'OptionController@location')
        ->name('option.location.update');
    Route::post('/option/update/{id}/motivation', 'OptionController@motivation')
        ->name('option.motivation.update');

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
