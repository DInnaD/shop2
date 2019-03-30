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


	Route::get('/', 'HomeController@index')->name('home.index');
	//Route::get('/book/{id}', 'BooksController@show');
	//Route::get('/magazin/{id}', 'MagazinsController@show');
	
//Route::get('/book', 'BooksController@show');
// Route::get('/book/{id}', 'BooksController@show');
//Route::get('/magazin/{id}', 'MagazinsController@show');
	// Route::get('/book/{slug}', 'HomeController@showBook')->name('home.showBook');
	// Route::get('/magazin/{slug}', 'HomeController@showMagazin')->name('home.showMagazin');


	Route::group(['middleware'	=>	'auth'], function(){
	//Route::prefix('/order/{order}')->group(function () {
	Route::get('/cart', 'PurchasesController@indexCart')->name('cart');
	Route::get('/order', 'PurchasesController@index')->name('purchases.index');
	Route::post('/purchase', 'PurchasesController@store');
	Route::get('/purchase/{id}', 'PurchasesController@edit')->name('purchases.edit');//do I use it?
	Route::put('/purchase/{id}/update', 'PurchasesController@update')->name('purchases.update');
	Route::delete('/purchases/{id}/destroy', 'PurchasesController@destroy')->name('purchases.destroy');
	Route::delete('/purchasesAll/destroy', 'PurchasesController@destroyAll')->name('purchases.destroyAll');
	Route::get('/purchasebuy', 'PurchasesController@buy')->name('purchases.buy');
	Route::get('/purchases/toggleBeforeToggle/{id}', 'PurchasesController@toggleBeforeToggle');


//});//edit desperce routes
	Route::get('/orders', 'OrdersController@index')->name('orders.index');
	Route::get('/ordersall', 'OrdersController@indexAll')->name('ordersAll.index');
	Route::get('/order/{id}', 'OrdersController@show')->name('orders.show');	
	//Route::delete('/orsers/{id}/destroy', 'OrdersController@destroy')->name('orders.destroy');
	//Route::delete('/orsers/{id}/destroyAll', 'OrdersController@destroyAll')->name('orders.destroyAll');
	Route::get('/profile', 'ProfileController@index');
	Route::post('/profile', 'ProfileController@store');
	Route::get('/logout', 'AuthController@logout');
});

 Route::group(['middleware'	=>	'guest'], function(){
 	Route::get('/register', 'AuthController@registerForm');
 	Route::post('/register', 'AuthController@register');
 	Route::get('/login','AuthController@loginForm')->name('login');
 	Route::post('/login', 'AuthController@login');
 });

 Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware'	=>	'admin'], function(){
 	Route::get('/', 'DashboardController@index');
	Route::resource('/users', 'UsersController');
	Route::get('/users/toggleAdmin/{id}', 'UsersController@toggleAdmin');
	//Route::get('/user/{id}', 'UsersController@show')->name('users.show');
	Route::get('/users/toggleDiscontId/{id}', 'UsersController@toggleDiscontId');
	Route::get('/users/toggleBan/{id}', 'UsersController@toggleBan');
	Route::get('/users/toggleDiscontIdAll', 'UsersController@toggleDiscontIdAll')->name('admin.users.toggleDiscontIdAll');
	//Route::whenRegex('/^admin(\/(?/book)\S+)?S/','Restricted:admin');
	Route::resource('/books', 'BooksController');
	Route::get('/books/toggleDiscontGLB/{id}', 'BooksController@toggleDiscontGLB');
	Route::get('/books/toggleDiscontGLBAll', 'BooksController@toggleDiscontGLBAll')->name('admin.books.toggleDiscontGLBAll');
	Route::get('/books/toggleHard/{id}', 'BooksController@toggleHard');
	//Route::whenRegex('/^admin(\/(?/magazin)\S+)?S/','Restricted:admin');
	Route::resource('/magazins', 'MagazinsController');
	Route::get('/magazins/toggleDiscontGLM/{id}', 'MagazinsController@toggleDiscontGLM');
	Route::get('/magazins/toggleDiscontGLMAll', 'MagazinsController@toggleDiscontGLMAll')->name('admin.magazins.toggleDiscontGLMAll');
	Route::get('/purchases/toggle/{id}', 'PurchasesController@toggle');
	Route::get('/purchases', 'PurchasesController@index')->name('admin.purchases.index');
	Route::delete('/purchases/{id}/destroyAll', 'PurchasesController@destroyAll')->name('purchases.destroyAll');
	Route::get('/purchasesdaybefore', 'PurchasesController@indexDayBefore')->name('admin.purchases.indexDayBefore');
	Route::get('/purchasesweekbefore', 'PurchasesController@indexWeekBefore')->name('admin.purchases.indexWeekBefore');
	Route::get('/purchasesmonthbefore', 'PurchasesController@indexMonthBefore')->name('admin.purchases.indexMonthBefore');
	Route::get('/statistics', 'StatisticsController@index')->name('admin.statistics.index');
	Route::get('/statistics', 'StatisticsController@show')->name('admin.statistics.show');

 });

	