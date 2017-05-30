<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('home/guestbook','Home\IndexController@guestbook');
Route::get('home/guest','Home\IndexController@guest');
Route::post('home/sendmsg','Home\IndexController@sendmsg');
Route::get('/','Home\IndexController@index');
Route::get('/cate/{cate_id}','Home\IndexController@cate');
Route::get('/a/{id}','Home\IndexController@article');
Route::get('test','IndexController@index');
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
	Route::any('login','LoginController@login');
Route::get('code','LoginController@code');
Route::get('getcode','LoginController@code');
Route::get('crypt','LoginController@crypt');
Route::get('quit','IndexController@quit');


Route::get('guest','Home\IndexController@guest');

});

		/*==========中间件的引用=======*/

Route::group(['prefix' => 'admin','namespace' => 'Admin','middlewareGruops' => ['web','admin.login']], function () {
Route::get('welcome','IndexController@welcome');
Route::get('info','IndexController@info');	
 Route::get('element','IndexController@element');
 Route::get('tab','IndexController@tab');
 Route::get('img','IndexController@img');
 Route::get('list','IndexController@lister');
 Route::get('add','IndexController@addpage');
 Route::any('pass','IndexController@pass');
 /*================测试代码=================*/
 Route::any('test','IndexController@test');
 #==================异步验证================
 Route::post('cate/changerOrder', 'CategoryController@changerOrder');
# ===============资源路由===================
Route::resource('category', 'CategoryController');
Route::resource('article', 'ArticleController');
Route::resource('links', 'LinksController');
Route::post('links/changerOrder', 'LinksController@changerOrder');
Route::resource('article/create', 'ArticleController@create');
Route::any('upload','CommonController@upload');
Route::resource('navs', 'NavsController');
Route::post('navs/changerOrder', 'NavsController@changerOrder');
Route::resource('config', 'ConfigController');
Route::resource('config/create', 'ConfigController@create');
Route::post('config/changeContent', 'ConfigController@changeContent');
Route::get('config/conifg/putconfig', 'ConfigController@putconfig');
Route::post('config/changerOrder', 'ConfigController@changerOrder');
});





