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
    Route::get('/', 'LoginController@login')->name('index');
    Route::get('/loginApi', 'LoginController@loginApi')->name('loginApi');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/home', 'StoreMitdorController@index')->name('home');
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
    Route::get('detail/{id}', 'ViewMitdorController@detail')->name('detail');
    Route::get('update', 'ViewMitdorController@update')->name('update');
});

Route::group(['as'=>'ProdukMitraVendor.'], function(){
    Route::get('produk/{id}', 'ProdukMitdorController@TambahProduk')->name('produk');

    Route::get('TambahKategori', 'ProdukMitdorController@TambahKategori')->name('TambahKategori');
    Route::get('StoreKategori', 'ProdukMitdorController@StoreKategori')->name('StoreKategori');
    Route::get('UpdateKategori', 'ProdukMitdorController@UpdateKategori')->name('UpdateKategori');
    
    Route::get('GetSubKategori', 'ProdukMitdorController@GetSubKategori')->name('GetSubKategori');

    Route::get('StoreProduk', 'ProdukMitdorController@StoreProduk')->name('StoreProduk'); 

    Route::get('TambahImageProduk/{id}', 'ProdukMitdorController@TambahImageProduk')->name('TambahImageProduk');   
    Route::get('StoreImageProduk', 'ProdukMitdorController@StoreImageProduk')->name('StoreImageProduk');   


    Route::get('DetailProduk/{id}', 'ProdukMitdorController@DetailProduk')->name('DetailProduk');   
    
});

Route::group(['as'=>'Orderproduk.'], function(){
    Route::get('OrderProduk', 'OrderProdukController@OrderProduk')->name('OrderProduk'); 
    Route::get('ListProduk', 'OrderProdukController@ListProduk')->name('ListProduk'); 
    Route::get('LihatPesanan', 'OrderProdukController@LihatPesanan')->name('LihatPesanan'); 
    Route::get('DetailPesanan/{id}', 'OrderProdukController@DetailPesanan')->name('DetailPesanan'); 
    Route::get('BatalkanPesanan/{id}', 'OrderProdukController@BatalkanPesanan')->name('BatalkanPesanan'); 
    Route::get('DealPesanan', 'OrderProdukController@DealPesanan')->name('DealPesanan'); 
    Route::get('LunasiPesanan', 'OrderProdukController@LunasiPesanan')->name('LunasiPesanan'); 
    
    Route::get('ListPemesanan', 'OrderProdukController@ListPemesanan')->name('ListPemesanan'); 

    
});

