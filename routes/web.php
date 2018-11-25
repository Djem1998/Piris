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

Auth::routes();
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/addUser', 'HomeController@index')->name('addUser');
Route::post('/add', 'UserInfoController@add')->name('add');
Route::post('/checkUser', 'UserInfoController@checkUserName')->name('checkUser');
Route::post('/checkUserPassport', 'UserInfoController@checkUserPassport')->name('checkUserPassport');
Route::post('/checkIdentificationNumber', 'UserInfoController@checkIdentificationNumber')->name('checkIdentificationNumber');
