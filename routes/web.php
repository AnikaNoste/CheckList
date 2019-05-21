<?php
session_start();
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

Route::get('/', ['as'=> 'home', 'uses'=>'Admin\IndexController@show']);
Route::get('/home', ['as'=> 'home', 'uses'=>'Admin\IndexController@show']);
//РЕГИСТРАЦИЯ
Route::get('/register/{login}/{password}/{email}', 
		['as'=> 'register', 
		'uses'=>'RegisterController@create']);

//ВХОД
Route::get('/login/{email}/{password}', 
		['as'=> 'login', 'uses'=>'LoginController@login']);

//ВЫХОД
Route::get('/logout', ['as'=> 'logout', 
		'uses'=>'Auth\LoginController@logout']);

//ОШИБКА	
Route::get('/error', ['as'=> 'error', function () {
    return view('error');
}]);


//АДМИН
//просмотр всех чеклистов
Route::get('/admin/list', 
		['as'=> 'adminList', 
		'uses'=>'Admin\CheckListController@showAll', 
		'middleware' => ['auth', 'admin2', 'adminIsNotEmpty']]);

//просмотр чеклиста по ID
Route::get('/admin/list/{id}', 
		['as'=> 'adminListById', 
		'uses'=>'Admin\CheckListController@getListById', 
		'middleware' => ['auth', 'admin2', 'adminIsNotEmpty', 'adminIsList', 'adminIsNotEmptyList']]);

//просмотр чеклистов с сортировкой
Route::get('/admin/list/sort/{field}', 
		['as'=> 'adminAllListsSortUser', 
		'uses'=>'Admin\CheckListController@showAllSort', 
		'middleware' => ['auth', 'admin2', 'adminIsNotEmpty', 'adminSort']]);

//просмотр чеклистов по userID
Route::get('/admin/list/user/{id}', 
		['as'=> 'adminListsByUserId', 
		'uses'=>'Admin\CheckListController@getListsByUserId', 
		'middleware' => ['auth', 'admin2', 'adminIsNotEmpty', 'adminUserList']]);

		
//АДМИН (роль = 1)		
//блокировка пользователя
Route::get('/admin/user/{id}/block', 
		['as'=> 'adminBlockUser', 
		'uses'=>'Admin\UserController@blockUser', 
		'middleware' => ['auth', 'admin1', 'hasUser', 'userIsAdmin']]);
		
//разблокировка пользователя
Route::get('/admin/user/{id}/unblock', 
		['as'=> 'adminBlockUser', 
		'uses'=>'Admin\UserController@unblockUser', 
		'middleware' => ['auth', 'admin1', 'hasUser', 'userIsAdmin']]);
		
//управление количеством возможных чек листов у пользователя
Route::get('/admin/user/{id}/setNumberList/{number}', 
		['as'=> 'adminSetNumberList', 
		'uses'=>'Admin\UserController@setNumberList', 
		'middleware' => ['auth', 'admin1', 'hasUser']]);

		
//ПОЛЬЗОВАТЕЛЬ
//просмотр своих чеклистов
Route::get('/list', 
	['as'=> 'userAllLists', 
	'uses'=>'User\CheckListController@showAll',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty']]);

//просмотр конкреткого чеклиста
Route::get('/list/{id}', 
	['as'=> 'userListById', 
	'uses'=>'User\CheckListController@getListById',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isList', 'isNotEmptyList']]); 

//создание чеклиста
Route::get('/create/list/{titleList}', 
	['as'=> 'userCreateList', 
	'uses'=>'User\CheckListController@createList',
	'middleware' => ['auth', 'isBlock','limitCount']]);

//удаление чеклиста
Route::get('/delete/list/{id}', 
	['as'=> 'userDeleteList', 
	'uses'=>'User\CheckListController@deleteList',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isList']]); 

//удаление выполненных чеклистов
Route::get('/delete/lists', 
	['as'=> 'userDeleteList', 
	'uses'=>'User\CheckListController@deleteLists',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty']]); 

//создание пункта в чеклисте
Route::get('/create/item/{id}/{text}', 
	['as'=> 'userCreateList', 
	'uses'=>'User\CheckListController@createItem',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isList']]); 

//удаление пункта в чеклисте
Route::get('/delete/item/{id}', 
	['as'=> 'userCreateList', 
	'uses'=>'User\CheckListController@deleteItem',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isItem']]); 
	
//отметка пункта готовым
Route::get('/item/{id}/ok', 
	['as'=> 'userItemOk', 
	'uses'=>'User\CheckListController@OkItem',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isItem']]); 

//отметка пункта неготовым
Route::get('/item/{id}/no', 
	['as'=> 'userItemNo', 
	'uses'=>'User\CheckListController@NoItem',
	'middleware' => ['auth', 'isBlock', 'isNotEmpty', 'isItem']]); 


Auth::routes();
Route::auth();