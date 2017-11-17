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

Route::get('medsmenas/{medservice}/create', 'MedSmenaController@createWithService')->middleware('can:create,medservice');
Route::resource('medsmenas', 'MedSmenaController');

Route::get('/patients', 'PatientsController@index');
Route::get('/patients/{medsmena}', 'PatientsController@getTalone');