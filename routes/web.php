<?php
Route::get('/',										'App\IndexController@index')->				name('index');
Route::get('/en',									'App\IndexController@en')->					name('en');
Route::get('/zh',									'App\IndexController@zh')->					name('zh');
// Route::post('/order',								'App\IndexController@order')->				name('order');

/* Route::get('/confirm',							'App\IndexController@confirm')->			name('confirm');
Route::get('/verify/{id}/{etag}',					'App\IndexController@verify')->				name('verify');
Route::get('/pay',									'App\IndexController@deposit')->			name('deposit');
Route::get('/result',								'App\IndexController@result')->				name('result');
 */
Route::post('/plan',								'App\IndexController@plan');
Route::post('/coupon',								'App\IndexController@coupon');

Route::get('/login',								'App\AuthController@login')->				name('login');
Route::post('/login',								'App\AuthController@loginSubmit')->			name('login.submit');

Route::get('/register',								'App\AuthController@register')->			name('register');
Route::post('/register',							'App\AuthController@registerSubmit')->		name('register.submit');

Route::get('/logout',								'App\AuthController@logout')->			name('logout');

Route::get('/bitcoin/balance',					    'Bitcoin\BalanceController@index')->	    name('bitcoin.balance');
Route::post('/bitcoin/balance',					    'Bitcoin\BalanceController@submit')->	    name('bitcoin.balance.submit');

Route::get('/captcha',								'App\AppController@captcha')->				name('captcha');
Route::get('/qrcode',								'App\AppController@qrcode')->				name('qrcode');
Route::get('/download/image/{name}/{size}',			'App\AppController@image')->				name('image');
Route::get('/galaxy',			                    'DownloadController@index')->				name('download');
Route::get('/galaxy/{file}',			            'DownloadController@file')->				name('download.file');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/client',							'Client\IndexController@index')->			name('client');
	Route::get('/client/account/changepassword',	'Client\AccountController@index')->			name('account');
	Route::post('/client/account/resetpasswd',		'Client\AccountController@passwd')->		name('account.passwd');
	Route::get('/client/deposit',					'Client\DepositController@index')->			name('deposit');
	Route::get('/client/deposit/check',				'Client\DepositController@check')->			name('deposit.check');

	Route::get('/client/plan',						'Client\PlanController@index')->			name('plan');
	Route::post('/client/order',					'Client\PlanController@order')->			name('order');

	Route::get('/client/invoice',					'Client\InvoiceController@index')->			name('invoice');
});

