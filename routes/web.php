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
Route::group(['middleware' => ['auth', 'accessDenied']], function () {
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
    Route::get('/getSum/{currency}/{depositName}/{duration}', 'DepositController@getSum')->name('getSum');
    Route::get('/getCountAccounts/{id}', 'DepositController@getCountAccounts')->name('getCountAccounts');
    Route::post('/addDeposit', 'DepositController@addDeposit')->name('addDeposit');
});
Route::get('/bankDayClosing', 'DepositController@bankDayClosing')->name('bankDayClosing');
Route::get('/getName', 'DepositController@getName')->name('getName');
Route::get('/getCurrency', 'DepositController@getCurrency')->name('getCurrency');
Route::get('/viewAddCredit', 'CreditController@index')->name('viewAddCredit');
Route::get('/getDurationCredit/{currency}/{depositName}', 'CreditController@getDuration')->name('getDurationCredit');
Route::get('/getPercentCredit/{currency}/{depositName}/{duration}', 'CreditController@getPercent')->name('getPercentCredit');
Route::get('/getNameCredit', 'CreditController@getName')->name('getNameCredit');
Route::get('/getCurrencyCredit', 'CreditController@getCurrency')->name('getCurrencyCredit');
Route::get('/getCountAccountsCredit/{id}', 'CreditController@getCountAccounts')->name('getCountAccountsCredit');
Route::post('/addCredit', 'CreditController@addCredit')->name('addCredit');
Route::get('/getSumCredit/{currency}/{depositName}/{duration}', 'CreditController@getSumCredit')->name('getSumCredit');
Route::get('/bankDayClosingCredit', 'CreditController@bankDayClosing')->name('bankDayClosingCredit');
Route::get('/viewTerminal', 'TerminalController@index')->name('viewTerminal');
Route::post('/checkAutorization', 'TerminalController@checkAutorization')->name('checkAutorization');
Route::post('/getMoneyFromCredit', 'TerminalController@getMoneyFromCredit')->name('getMoneyFromCredit');
Route::post('/getAccountBalance', 'TerminalController@getAccountBalance')->name('getAccountBalance');
Route::post('/getPercentFromInterestAccount', 'DepositController@getPercentFromInterestAccount')->name('getPercentFromInterestAccount');
Route::post('/endDeposit', 'DepositController@endDeposit')->name('endDeposit');
Route::get('/getPercentSumCredit/{card_num}', 'CreditController@getPercentSumCredit')->name('getPercentSumCredit');
Route::post('/interestPayment', 'CreditController@interestPayment')->name('interestPayment');
Route::post('/endCredit', 'CreditController@endCredit')->name('endCredit');
