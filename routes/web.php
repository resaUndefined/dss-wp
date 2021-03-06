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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/login/custom', 'LoginController@login')->name('login.custom');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::group(['middleware' => ['web', 'auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('alternatif', 'AlternatifController');
	Route::resource('kriteria', 'KriteriaController');
	Route::resource('nilai-alternatif', 'NilaiAlternatifController');
	Route::get(
			'/sub-kriteria/{kriteria}/tambah',
			'KriteriaController@sub_kriteria')->name('subkriteria.create');
	Route::post(
			'/sub-kriteria',
			'KriteriaController@sub_kriteria_save')->name('subkriteria.save');
	Route::get(
			'/sub-kriteria/{subkriteria}/edit',
			'KriteriaController@sub_kriteria_edit')->name('subkriteria.edit');
	Route::put(
			'/sub-kriteria/update',
			'KriteriaController@sub_kriteria_update')->name('subkriteria.update');
	Route::get(
			'/penilaian/{periode}/edit/{alternatif}',
			'NilaiAlternatifController@edit_penilaian')->name('penilaian.edit');
	Route::put(
			'/penilaian/{periode}/update/{alternatif}',
			'NilaiAlternatifController@update_penilaian')->name('penilaian.update');
	Route::get(
			'/penilaian/{periode}/proses',
			'NilaiAlternatifController@proses_penilaian')->name('penilaian.proses');
	Route::get(
			'/data-mining',
			'DataMiningController@index')->name('datamining.index');
	Route::get(
			'/data-mining/export-usia/{type}',
			'DataMiningController@export_usia')->name('datamining.usia');
	Route::get(
			'/data-mining/export-riwayat/{type}',
			'DataMiningController@export_riwayat')->name('datamining.riwayat');
	Route::delete(
			'/sub-kriteria/{id}',
			'KriteriaController@sub_kriteria_delete')->name('subkriteria.destroy');
});
