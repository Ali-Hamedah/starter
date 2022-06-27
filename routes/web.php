<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



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






Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', 'HomeController@index');

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

//Route::get('/fillable', 'CrudController@getOffers');



Route::group(['prefix' => LaravelLocalization::setlocale()], function(){
    Route::group(['prefix' => 'offers'], function(){


		Route::get('create', 'CrudController@create');


        //Route::get('create', 'CrudController@create');

         //Route::get('create', 'CrudController@create');
        // Route::get('create', 'CrudController@create');
    Route::post('store', 'CrudController@store')->name('offers.store');
    });


});




