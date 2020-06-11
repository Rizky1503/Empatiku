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
    Route::get('/', 'StoreMitdorController@index')->name('index');
});

Route::group(['as'=>'MitraVendor.'], function(){
    Route::get('/TambahMitraVendor', 'StoreMitdorController@TambahMitraVendor')->name('TambahMitraVendor');
    Route::get('/TambahMitraVendor/PIC/{id_mitdor}', 'StoreMitdorController@TambahPicMitraVendor')->name('TambahPicMitraVendor');
    Route::get('/TambahMitraVendor/Berkas/{id_mitdor}','StoreMitdorController@TambahBerkasMitraVendor')->name('TambahBerkasMitraVendor');

    Route::get('/getKota', 'StoreMitdorController@getKota')->name('getKota');

    Route::get('/StoreMitdor', 'StoreMitdorController@StoreMitdor')->name('StoreMitdor');
    Route::get('/StoreMitdorPIC', 'StoreMitdorController@StoreMitdorPIC')->name('StoreMitdorPIC');
    Route::post('/StoreMitdorBerkas', 'StoreMitdorController@StoreMitdorBerkas')->name('StoreMitdorBerkas');
    
});

Route::group(['as'=>'ViewMitraVendor.'], function(){
    Route::get('list', 'ViewMitdorController@index')->name('index');
});


