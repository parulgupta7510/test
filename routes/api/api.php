<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Users

Route::prefix('/user')->group( function() {
	Route::post('/login', 'api\LoginController@login');
	Route::post('/register', 'api\LoginController@register');
});

Route::group(['middleware' => 'auth:api'], function(){

	Route::prefix('/product')->group( function() {
		Route::get('/index', 'api\user\ProductController@index');
		Route::post('/create', 'api\user\ProductController@create');
		Route::get('/{id}', 'api\user\ProductController@show');
		Route::put('/{id}', 'api\user\ProductController@update');
		Route::delete('/{id}', 'api\user\ProductController@destroy');
	});


	Route::prefix('/category')->group( function() {
		Route::get('/index', 'api\user\CategoryController@index');
		Route::post('/create', 'api\user\CategoryController@create');
		Route::get('/{id}', 'api\user\ProductController@show');
		Route::put('/{id}', 'api\user\CategoryController@update');
		Route::delete('/{id}', 'api\user\CategoryController@destroy');
	});
});


