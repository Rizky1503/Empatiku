<?php

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



Route::group(['as'=>'Home.'], function(){
    Route::get('/', 'HomeController@index')->name('index');
});

Route::group(['as'=>'MitraVendor.'], function(){
    Route::get('/TambahMitraVendor', 'HomeController@TambahMitraVendor')->name('TambahMitraVendor');
    Route::get('/TambahMitraVendor/PIC/{id_mitdor}', 'HomeController@TambahPicMitraVendor')->name('TambahPicMitraVendor');
    Route::get('/TambahMitraVendor/Berkas/{id_mitdor}','HomeController@TambahBerkasMitraVendor')->name('TambahBerkasMitraVendor');

    Route::get('/getKota', 'HomeController@getKota')->name('getKota');

    Route::get('/StoreMitdor', 'HomeController@StoreMitdor')->name('StoreMitdor');
    Route::get('/StoreMitdorPIC', 'HomeController@StoreMitdorPIC')->name('StoreMitdorPIC');
    Route::post('/StoreMitdorBerkas', 'HomeController@StoreMitdorBerkas')->name('StoreMitdorBerkas');
    

  
});


