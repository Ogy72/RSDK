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

//Route Default
//Route::get('/', function () {
//    return view('welcome');
//});

//Route ke halaman utama
Route::get('/', function(){
    return view('layout.HalamanUtama');
});

//Route data dokter
Route::get('/data-dokter', 'DokterController@view');
Route::get('/data-dokter/add', 'DokterController@add');
Route::post('/data-dokter/store', 'DokterController@store');
Route::get('/data-dokter/search', 'DokterController@search');
Route::get('/data-dokter/info/{nid}', 'DokterController@info');
Route::get('/data-dokter/edit/{nid}', 'DokterController@edit');
Route::put('/data-dokter/update/{nid}', 'DokterController@update');
Route::get('/data-dokter/hapus/{nid}', 'DokterController@destroy');

//Route data perawat
Route::get('/data-perawat', 'PerawatController@view');
Route::get('/data-perawat/add', 'PerawatController@add');
Route::post('/data-perawat/store', 'PerawatController@store');
Route::get('/data-perawat/search', 'PerawatController@search');
Route::get('/data-perawat/info/{nip}', 'PerawatController@info');
Route::get('/data-perawat/edit/{nip}', 'PerawatController@edit');
Route::put('/data-perawat/update/{nip}', 'PerawatController@update');
Route::get('/data-perawat/hapus/{nip}', 'PerawatController@destroy');

//Route data tindakan
Route::get('/data-tindakan', 'TindakanController@view');
Route::get('/data-tindakan/add', 'TindakanController@add');
Route::post('/data-tindakan/store', 'TindakanController@store');
Route::get('/data-tindakan/search', 'TindakanController@search');
Route::get('/data-tindakan/edit/{id}', 'TindakanController@edit');
Route::put('/data-tindakan/update/{id}', 'TindakanController@update');
Route::get('/data-tindakan/hapus/{id}', 'TindakanController@destroy');

//Route data penyakit
Route::get('/data-penyakit', 'PenyakitController@view');
Route::get('/data-penyakit/add', 'PenyakitController@add');
Route::post('/data-penyakit/store', 'PenyakitController@store');
Route::get('/data-penyakit/search', 'PenyakitController@search');
Route::get('/data-penyakit/edit/{id}', 'PenyakitController@edit');
Route::put('/data-penyakit/update/{id}', 'PenyakitController@update');
Route::get('/data-penyakit/hapus/{id}', 'PenyakitController@destroy');

//Route data satuan
Route::get('/data-satuan', 'SatuanController@view');
Route::get('/data-satuan/add', 'SatuanController@add');
Route::post('/data-satuan/store', 'SatuanController@store');
Route::get('/data-satuan/search', 'SatuanController@search');
Route::get('/data-satuan/edit/{id}', 'SatuanController@edit');
Route::put('/data-satuan/update/{id}', 'SatuanController@update');
Route::get('/data-satuan/hapus/{id}', 'SatuanController@destroy');

//Route data obat
Route::get('/data-obat', 'ObatController@view');
Route::get('/data-obat/add', 'ObatController@add');
Route::post('/data-obat/store', 'ObatController@store');
Route::get('/data-obat/search', 'ObatController@search');
Route::get('/data-obat/edit/{id}', 'ObatController@edit');
Route::put('/data-obat/update/{id}', 'ObatController@update');
Route::get('/data-obat/hapus/{id}', 'ObatController@destroy');
