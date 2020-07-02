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
Route::group(['middleware' => ['web', 'auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('alternatif', 'AlternatifController');
	Route::resource('kriteria', 'KriteriaController');
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
});
