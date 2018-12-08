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
Route::get('/deleteUser', 'DeleteController@index')->name('deleteUser');
Route::post('/delete', 'UserInfoController@delete')->name('delete');
Route::get('/editingUser', 'EditingController@index')->name('editingUser');
Route::get('/getUserInfoByID/{id}', 'UserInfoController@getUserInfoByID')->name('getUserInfoByID');
Route::get('/getCitizenship', 'EditingController@getCitizenshipTable')->name('getCitizenship');
Route::get('/getDisability', 'EditingController@getDisabilityTable')->name('getDisability');
Route::get('/getFamilyPosition', 'EditingController@getFamilyPositionTable')->name('getFamilyPosition');
Route::get('/getResidenceCity', 'EditingController@getResidenceCityTable')->name('getResidenceCity');
Route::get('/getRegistrationCity', 'EditingController@getRegistrationCityTable')->name('getRegistrationCity');
Route::post('/update', 'UserInfoController@update')->name('update');
Route::get('/viewAddDeposit', 'DepositController@index')->name('viewAddDeposit');
Route::get('/getDuration/{currency}/{depositName}', 'DepositController@getDuration')->name('getDuration');
Route::get('/getPercent/{currency}/{depositName}/{duration}', 'DepositController@getPercent')->name('getPercent');
Route::get('/getCountAccounts/{id}', 'DepositController@getCountAccounts')->name('getCountAccounts');
Route::post('/addDeposit', 'DepositController@addDeposit')->name('addDeposit');
