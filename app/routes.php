<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::controller('users', 'UsersController');
Route::resource('subscriptions', 'SubscriptionsController');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('lessons', 'LessonsController');
	Route::post('transactions/createNewCustomer', 'TransactionController@createNewCustomer');
	
});