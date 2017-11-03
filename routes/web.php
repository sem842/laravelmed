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
Route::get('/groups/manage', 'GroupController@manage');
Route::post('/groups/manage', 'GroupController@assign');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('groups', 'GroupController');
Route::resource('medservices', 'MedServiceController');
Route::resource('medsmenas', 'MedSmenaController');


