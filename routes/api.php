<?php

use Illuminate\Http\Request;

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

Route::get('home',				'API\HomeController@index');
Route::get('brands',			'API\BrandsController@index');
Route::get('colors',			'API\ColorsController@index');
Route::get('languages',			'API\LanguagesController@index');
Route::get('guides',			'API\GuidesController@index');
Route::get('faq',				'API\FaqsController@index');
Route::get('options',			'API\OptionsController@index');
Route::get('cars',				'API\ProductsController@index');
Route::get('accessories',		'API\ProductsController@accessories');
Route::get('categories',		'API\CategoriesController@index');
Route::get('models',			'API\ModelsController@index');
Route::get('settings',			'API\SettingsController@index');
Route::get('pages',				'API\SettingsController@pages');
Route::get('sliders',			'API\SlidersController@index');
Route::get('tracking',			'API\OrdersController@tracking');
Route::post('order',			'API\OrdersController@new_order');
Route::get('categories/list',	'API\CategoriesController@index');

Route::get('orders/pay_page/{id}',	'API\OrdersController@pay_page')->name('api_pay_page');
Route::any('orders/pay_result',		'API\OrdersController@pay_result')->name('pay_result');


Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
