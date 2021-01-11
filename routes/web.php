<?php

use Illuminate\Support\Facades\Route;

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



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

	Auth::routes();

	Route::group(['middleware' => ['auth']], function () {

		
		Route::get('/home', 'HomeController@index')->name('home');

		/*
	    |----------------------------------------------------------------------
	    | ROTAS PERFIS
	    |----------------------------------------------------------------------
	    */
	    	// Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
	     //        Route::get('/index', 'Admin/RoleController@index')->name('index');
	     //        Route::get('/list', 'Admin/RoleController@datatables')->name('list');
	     //        Route::get('/create', 'Admin/RoleController@create')->name('create');
	     //        Route::post('/create', 'Admin/RoleController@store')->name('store');
	     //        Route::get('/{role}/edit', 'Admin/RoleController@edit')->name('edit');
	     //        Route::patch('/{role}', 'Admin/RoleController@update')->name('update');
	     //        Route::delete('/{role}', 'Admin/RoleController@destroy')->name('delete');
	     //    });

	    /*
	    |----------------------------------------------------------------------
	    | ROTAS PERMISSÕES
	    |----------------------------------------------------------------------
	    */
	    	// Route::group(['prefix' => 'abilities', 'as' => 'abilities.'], function () {
	     //        Route::get('/index', 'Admin/AbilityController@index')->name('index');
	     //        Route::get('/list', 'Admin/AbilityController@datatables')->name('list');
	     //        Route::get('/create', 'Admin/AbilityController@create')->name('create');
	     //        Route::post('/create', 'Admin/AbilityController@store')->name('store');
	     //        Route::get('/{ability}/edit', 'Admin/AbilityController@edit')->name('edit');
	     //        Route::patch('/{ability}', 'Admin/AbilityController@update')->name('update');
	     //        Route::delete('/{ability}', 'Admin/AbilityController@destroy')->name('delete');
	     //    });
	   
	    /*
	    |----------------------------------------------------------------------
	    | ROTAS USUÁRIOS
	    |----------------------------------------------------------------------
	    */

	    	// Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
	     //        Route::get('/index', 'Admin/UserController@index')->name('index');
	     //        Route::get('/list', 'Admin/UserController@datatables')->name('list');
	     //        Route::get('/create', 'Admin/UserController@create')->name('create');
	     //        Route::post('/create', 'Admin/UserController@store')->name('store');
	     //        Route::get('/{user}/edit', 'Admin/UserController@edit')->name('edit');
	     //        Route::patch('/{user}', 'Admin/UserController@update')->name('update');
	     //        Route::delete('/{user}', 'Admin/UserController@destroy')->name('delete');
	     //    });

        /*
        |----------------------------------------------------------------------
        | ROTAS NOTIFICATIONS
        |----------------------------------------------------------------------
        */

	        // Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
	        //     Route::get('/read-all', 'NotificationController@readAllNotification')->name('read-all');

	            // Route::get('/system-all-checked', 'NotificacaoController@readAllNotification')->name('system-check-all');
	            // Route::get('/{notification}', 'NotificacaoController@openNotification')->name('open-one');
	            // Route::get('/read/{notification}', 'NotificacaoController@readNotification')->name('read-one');
	        // });

	});
});

	


