<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




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



Route::group(['prefix' => LaravelLocalization::setlocale()], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::get('all', 'CrudController@getAllOffers')-> name('offers.all');

        Route::get('edit/{offer_id}', 'CrudController@editOffers');
        Route::post('update/{offer_id}', 'CrudController@updateOffers')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');

        Route::post('store', 'CrudController@store')->name('offers.store');

        //Route::get('create', 'CrudController@create');

        //Route::get('create', 'CrudController@create');
        // Route::get('create', 'CrudController@create');
    });
    Route::get('youtube', 'CrudController@getVideo')->middleware('auth');
});
################################# Begin Ajax Routes ###########################################
Route::group(['prefix' => 'ajax-offers'], function(){
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')-> name('ajax.offers.store');

    Route::get('all', 'OfferController@all')-> name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')-> name('ajax.offers.delete');

    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});

################################# End Ajax Routes ##############################################


################################# Begin Authentication && Guards #########################################
Route::group(['middleware' => 'CheckAge', 'namespace' => 'Auth'], function(){
    Route::get('adults', 'CustomAuthController@adult')-> name('adult');
});

Route::get('site', 'Auth\CustomAuthController@site')-> middleware('auth:web')-> name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')-> middleware('auth:admin')-> name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');

################################# End Authentication && Guards ###########################################

Route::get('/notAdult', function(){
return 'not Adults for my';
})-> name('not.adult');

################################# Begin one to many Relationship  ###########################################

Route::get('hospital-has-many', 'Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals', 'Relation\RelationsController@hospitals');
Route::get('doctors/{hospital_id}', 'Relation\RelationsController@doctors')-> name('hospital.doctors');
Route::get('hospitals/{hospital_id}', 'Relation\RelationsController@hospitalsDelete')-> name('hospital.delete');

Route::get('create', 'Relation\RelationsController@create');
Route::post('store', 'Relation\RelationsController@store')-> name('relation.store');

Route::get('create_doctors', 'Relation\DoctorsController@create');
Route::post('store', 'Relation\DoctorsController@store')-> name('doctors.store');

Route::get('hospitals-has-doctors', 'Relation\RelationsController@hospitalsHasDoctors');
Route::get('hospitals_has-doctors_male', 'Relation\RelationsController@hospitalshasdoctorsmale');
Route::get('hospitals_not_has-doctors', 'Relation\RelationsController@hospitalsNotHasDoctors');

################################# End one to many Relationship  ###########################################

################################# Begin many to many Relationship  ###########################################

Route::get('doctors_services', 'Relation\RelationsController@getDoctorServices');
//Route::get('services_doctors', 'Relation\RelationsController@getServicesDoctors');

Route::get('services_doctors/{doctor_id}', 'Relation\RelationsController@getServicesDoctors')-> name('doctors.services');
Route::post('saveServices_toDoctor', 'Relation\RelationsController@saveServicesToDoctors')-> name('save.doctors.services');



################################# End man to many Relationship  ###########################################
