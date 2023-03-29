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


Route::get('/', 'WEB\AR\IndexController@index');
Route::get('/about-us', 'WEB\AR\IndexController@about');
Route::get('/cars', 'WEB\AR\IndexController@cars');
Route::get('/cars/search', 'WEB\AR\IndexController@cars_search')->name('cars.search');
Route::get('/cars/search/advanced', 'WEB\AR\IndexController@cars_search_advanced')->name('cars.search.advanced');
Route::get('/offers', 'WEB\AR\IndexController@offers');
Route::get('/offers/search', 'WEB\AR\IndexController@offers_search')->name('offers.search');
Route::get('/offers/search/advanced', 'WEB\AR\IndexController@offers_search_advanced')->name('offers.search.advanced');
Route::get('/contact', 'WEB\AR\IndexController@contact');
Route::post('/contact', 'WEB\AR\IndexController@add_contact')->name('contact');
Route::get('/export', 'WEB\AR\IndexController@export');
Route::get('/common-questions', 'WEB\AR\IndexController@questions');
Route::get('/kamaliat', 'WEB\AR\IndexController@kmaliat');
Route::get('/learn', 'WEB\AR\IndexController@learn');
Route::get('/privacyPolicy.php', 'WEB\AR\IndexController@privacy');
Route::get('/condition', 'WEB\AR\IndexController@condition');
Route::get('/status/{id}', 'WEB\AR\IndexController@status')->name('status');
Route::get('/car/{id}', 'WEB\AR\IndexController@car');
Route::get('/export/car/{id}', 'WEB\AR\IndexController@export_car');
Route::get('/evaluations', 'WEB\AR\IndexController@evaluations');
Route::get('/tracking', 'WEB\AR\IndexController@tracking_view');
Route::post('/tracking', 'WEB\AR\IndexController@tracking')->name('tracking');
Route::post('/ar/send/export', 'WEB\AR\IndexController@add_export')->name('ar.send.export');
Route::post('/evaluation', 'WEB\AR\IndexController@add_evaluation')->name('evaluation');
Route::get('/order/{id}', 'WEB\AR\IndexController@order_view');
Route::post('/order/store', 'WEB\AR\IndexController@new_order')->name('order.store');
Route::post('/paid', 'WEB\AR\IndexController@paid_view')->name('paid');
Route::get('/paid/store', 'WEB\AR\IndexController@paid');
Route::get('/paytabs_payment', 'PaytabsController@index');
Route::get('/paytabs_response', 'PaytabsController@response');






Route::get('/en', 'WEB\EN\IndexController@index');
Route::get('/en/about-us', 'WEB\EN\IndexController@about');
Route::get('/en/cars', 'WEB\EN\IndexController@cars');
Route::get('/en/cars/search', 'WEB\EN\IndexController@cars_search')->name('en.cars.search');
Route::get('/en/cars/search/advanced', 'WEB\EN\IndexController@cars_search_advanced')->name('en.cars.search.advanced');
Route::get('/en/offers', 'WEB\EN\IndexController@offers');
Route::get('/en/offers/search', 'WEB\EN\IndexController@offers_search')->name('en.offers.search');
Route::get('/en/offers/search/advanced', 'WEB\EN\IndexController@offers_search_advanced')->name('en.offers.search.advanced');
Route::get('/en/contact', 'WEB\EN\IndexController@contact');
Route::post('/en/contact', 'WEB\EN\IndexController@add_contact')->name('en.contact');
Route::get('/en/export', 'WEB\EN\IndexController@export');
Route::get('/en/common-questions', 'WEB\EN\IndexController@questions');
Route::get('/en/kamaliat', 'WEB\EN\IndexController@kmaliat');
Route::get('/en/learn', 'WEB\EN\IndexController@learn');
Route::get('/en/privacyPolicy.php', 'WEB\EN\IndexController@privacy');
Route::get('/en/condition', 'WEB\EN\IndexController@condition');
Route::get('/en/status/{id}', 'WEB\EN\IndexController@status')->name('en.status');
Route::get('/en/tracking', 'WEB\EN\IndexController@tracking_view');
Route::post('/en/tracking', 'WEB\EN\IndexController@tracking')->name('en.tracking');
Route::get('/en/car/{id}', 'WEB\EN\IndexController@car');
Route::get('/en/export/car/{id}', 'WEB\EN\IndexController@export_car');
Route::post('/en/send/export', 'WEB\EN\IndexController@add_export')->name('en.send.export');
Route::get('/en/evaluations', 'WEB\EN\IndexController@evaluations');
Route::post('/en/evaluation', 'WEB\EN\IndexController@add_evaluation')->name('en.evaluation');
Route::get('/en/order/{id}', 'WEB\EN\IndexController@order_view');
Route::post('/en/order/store', 'WEB\EN\IndexController@new_order')->name('en.order.store');
Route::post('/en/paid', 'WEB\EN\IndexController@paid_view')->name('en.paid');
Route::post('/en/paid/store', 'WEB\EN\IndexController@paid')->name('en.paid.store');













Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();
Route::group(['middleware' => 'web','prefix' => config('app.prefix','admin')], function () {

	Route::get('/', 'Backend\HomeController@index');

	Route::get('administrators', 'Backend\AdministratorsController@index');
	Route::get('administrators/data', 'Backend\AdministratorsController@data');
	Route::post('administrators/add', 'Backend\AdministratorsController@add');
	Route::post('administrators/show', 'Backend\AdministratorsController@show_edit_form');
	Route::post('administrators/update', 'Backend\AdministratorsController@update');
	Route::post('administrators/edit', 'Backend\AdministratorsController@update');
	Route::post('administrators/delete', 'Backend\AdministratorsController@delete');
	Route::get('administrators/checkeuser', 'Backend\AdministratorsController@check_name');
	Route::get('administrators/checkemail', 'Backend\AdministratorsController@check_email');
	Route::post('administrators/change_status', 'Backend\AdministratorsController@change_status');

	Route::get('pages', 'Backend\PagesController@index');
	Route::get('pages/data', 'Backend\PagesController@data');
	Route::post('pages/add', 'Backend\PagesController@add');
	Route::post('pages/show', 'Backend\PagesController@show_edit_form');
	Route::post('pages/update', 'Backend\PagesController@update');
	Route::post('pages/delete', 'Backend\PagesController@delete');
	Route::post('pages/change_status', 'Backend\PagesController@change_status');

	Route::get('banners', 'Backend\BannersController@index');
	Route::get('banners/data', 'Backend\BannersController@data');
	Route::post('banners/add', 'Backend\BannersController@add');
	Route::post('banners/show', 'Backend\BannersController@show_edit_form');
	Route::post('banners/update', 'Backend\BannersController@update');
	Route::post('banners/delete', 'Backend\BannersController@delete');
	Route::post('banners/change_status', 'Backend\BannersController@change_status');

	Route::get('brands', 'Backend\BrandsController@index');
	Route::get('brands/data', 'Backend\BrandsController@data');
	Route::post('brands/add', 'Backend\BrandsController@add');
	Route::post('brands/show', 'Backend\BrandsController@show_edit_form');
	Route::post('brands/update', 'Backend\BrandsController@update');
	Route::post('brands/delete', 'Backend\BrandsController@delete');
	Route::post('brands/change_status', 'Backend\BrandsController@change_status');

	Route::get('categories', 'Backend\CategoriesController@index');
	Route::get('categories/data', 'Backend\CategoriesController@data');
	Route::post('categories/add', 'Backend\CategoriesController@add');
	Route::post('categories/show', 'Backend\CategoriesController@show_edit_form');
	Route::post('categories/update', 'Backend\CategoriesController@update');
	Route::post('categories/delete', 'Backend\CategoriesController@delete');
	Route::post('categories/change_status', 'Backend\CategoriesController@change_status');

	Route::get('colors', 'Backend\ColorsController@index');
	Route::get('colors/data', 'Backend\ColorsController@data');
	Route::post('colors/add', 'Backend\ColorsController@add');
	Route::post('colors/show', 'Backend\ColorsController@show_edit_form');
	Route::post('colors/update', 'Backend\ColorsController@update');
	Route::post('colors/delete', 'Backend\ColorsController@delete');
	Route::post('colors/change_status', 'Backend\ColorsController@change_status');

	Route::get('guides', 'Backend\GuidesController@index');
	Route::get('guides/data', 'Backend\GuidesController@data');
	Route::post('guides/add', 'Backend\GuidesController@add');
	Route::post('guides/show', 'Backend\GuidesController@show_edit_form');
	Route::post('guides/update', 'Backend\GuidesController@update');
	Route::post('guides/delete', 'Backend\GuidesController@delete');
	Route::post('guides/change_status', 'Backend\GuidesController@change_status');

	Route::get('models', 'Backend\ModelsController@index');
	Route::get('models/data', 'Backend\ModelsController@data');
	Route::post('models/add', 'Backend\ModelsController@add');
	Route::post('models/show', 'Backend\ModelsController@show_edit_form');
	Route::post('models/update', 'Backend\ModelsController@update');
	Route::post('models/delete', 'Backend\ModelsController@delete');
	Route::post('models/change_status', 'Backend\ModelsController@change_status');

	Route::get('options', 'Backend\OptionsController@index');
	Route::get('options/data', 'Backend\OptionsController@data');
	Route::post('options/add', 'Backend\OptionsController@add');
	Route::post('options/show', 'Backend\OptionsController@show_edit_form');
	Route::post('options/update', 'Backend\OptionsController@update');
	Route::post('options/delete', 'Backend\OptionsController@delete');
	Route::post('options/change_status', 'Backend\OptionsController@change_status');

	Route::get('tracking', 'Backend\TrackingController@index');
	Route::get('tracking/data', 'Backend\TrackingController@data');
	Route::post('tracking/add', 'Backend\TrackingController@add');
	Route::post('tracking/show', 'Backend\TrackingController@show_edit_form');
	Route::post('tracking/update', 'Backend\TrackingController@update');
	Route::post('tracking/delete', 'Backend\TrackingController@delete');
	Route::post('tracking/change_status', 'Backend\TrackingController@change_status');

	Route::get('offers', 'Backend\OffersController@index');
	Route::get('offers/data', 'Backend\OffersController@data');
	Route::post('offers/add', 'Backend\OffersController@add');
	Route::post('offers/show', 'Backend\OffersController@show_edit_form');
	Route::post('offers/update', 'Backend\OffersController@update');
	Route::post('offers/delete', 'Backend\OffersController@delete');
	Route::post('offers/change_status', 'Backend\OffersController@change_status');

	Route::get('fqa', 'Backend\FqaController@index');
	Route::get('fqa/data', 'Backend\FqaController@data');
	Route::post('fqa/add', 'Backend\FqaController@add');
	Route::post('fqa/show', 'Backend\FqaController@show_edit_form');
	Route::post('fqa/update', 'Backend\FqaController@update');
	Route::post('fqa/delete', 'Backend\FqaController@delete');
	Route::post('fqa/change_status', 'Backend\FqaController@change_status');

	Route::get('cars', 'Backend\ProductsController@index');
	Route::get('cars/data', 'Backend\ProductsController@data');
	Route::post('cars/add', 'Backend\ProductsController@add');
	Route::post('cars/delete_image/{id}', 'Backend\ProductsController@delete_image');
	Route::post('cars/show', 'Backend\ProductsController@show_edit_form');
	Route::post('cars/update', 'Backend\ProductsController@update');
	Route::post('cars/delete', 'Backend\ProductsController@delete');
	Route::post('cars/change_status', 'Backend\ProductsController@change_status');

	Route::get('accessories',						'Backend\AccessoriesController@index');
	Route::get('accessories/data',					'Backend\AccessoriesController@data');
	Route::post('accessories/add',					'Backend\AccessoriesController@add');
	Route::post('accessories/delete_image/{id}',	'Backend\AccessoriesController@delete_image');
	Route::post('accessories/show',					'Backend\AccessoriesController@show_edit_form');
	Route::post('accessories/update',				'Backend\AccessoriesController@update');
	Route::post('accessories/delete',				'Backend\AccessoriesController@delete');
	Route::post('accessories/change_status',		'Backend\AccessoriesController@change_status');

	Route::get('orders', 'Backend\OrdersController@index');
	Route::get('orders/data', 'Backend\OrdersController@data');
//    Route::post('orders/add', 'Backend\ProductsController@add');
	Route::post('orders/show', 'Backend\OrdersController@show_edit_form');
	Route::post('orders/update', 'Backend\OrdersController@update');
	Route::post('orders/delete', 'Backend\OrdersController@delete');
	Route::post('orders/change_status', 'Backend\OrdersController@change_status');

	Route::get('settings/', 'Backend\SettingsController@index');
	Route::post('settings/save', 'Backend\SettingsController@update');

	Route::get('notification/push', 'Backend\NotificationsController@index');
	Route::post('notification/send', 'Backend\NotificationsController@send');






	///////////////////////////////////////////////////////////////
	
	Route::get('addresses', 'Backend\AddressesController@index');
	Route::get('addresses/data', 'Backend\AddressesController@data');
	Route::post('addresses/add', 'Backend\AddressesController@add');
	Route::post('addresses/show', 'Backend\AddressesController@show_edit_form');
	Route::post('addresses/update', 'Backend\AddressesController@update');
	Route::post('addresses/delete', 'Backend\AddressesController@delete');
	Route::post('addresses/change_status', 'Backend\AddressesController@change_status');


	///////////////////////////////////////////////////////////////
	
	Route::get('contacts', 'Backend\ContactsController@index');
	Route::get('contacts/data', 'Backend\ContactsController@data');
	Route::post('contacts/show', 'Backend\ContactsController@show_edit_form');
	Route::post('contacts/delete', 'Backend\ContactsController@delete');
	Route::post('contacts/change_status', 'Backend\ContactsController@change_status');

	//////////////////////////////////////////////////////////////

	
	Route::get('methodologies', 'Backend\MethodologiesController@index');
	Route::get('methodologies/data', 'Backend\MethodologiesController@data');
	Route::post('methodologies/add', 'Backend\MethodologiesController@add');
	Route::post('methodologies/show', 'Backend\MethodologiesController@show_edit_form');
	Route::post('methodologies/update', 'Backend\MethodologiesController@update');
	Route::post('methodologies/delete', 'Backend\MethodologiesController@delete');
	Route::post('methodologies/change_status', 'Backend\MethodologiesController@change_status');

	//////////////////////////////////////////////////////////////////
	
	Route::get('features', 'Backend\FeaturesController@index');
	Route::get('features/data', 'Backend\FeaturesController@data');
	Route::post('features/add', 'Backend\FeaturesController@add');
	Route::post('features/show', 'Backend\FeaturesController@show_edit_form');
	Route::post('features/update', 'Backend\FeaturesController@update');
	Route::post('features/delete', 'Backend\FeaturesController@delete');
	Route::post('features/change_status', 'Backend\FeaturesController@change_status');

	///////////////////////////////////////////////////////////////////////////////////

	Route::get('countries', 'Backend\CountriesController@index');
	Route::get('countries/data', 'Backend\CountriesController@data');
	Route::post('countries/add', 'Backend\CountriesController@add');
	Route::post('countries/show', 'Backend\CountriesController@show_edit_form');
	Route::post('countries/update', 'Backend\CountriesController@update');
	Route::post('countries/delete', 'Backend\CountriesController@delete');
	Route::post('countries/change_status', 'Backend\CountriesController@change_status');

	///////////////////////////////////////////////////////////////////////////////////
	
	Route::get('evaluations', 'Backend\EvaluationsController@index');
	Route::get('evaluations/data', 'Backend\EvaluationsController@data');
	Route::post('evaluations/add', 'Backend\EvaluationsController@add');
	Route::post('evaluations/show', 'Backend\EvaluationsController@show_edit_form');
	Route::post('evaluations/update', 'Backend\EvaluationsController@update');
	Route::post('evaluations/delete', 'Backend\EvaluationsController@delete');
	Route::post('evaluations/change_status', 'Backend\EvaluationsController@change_status');



	////////////////////////////////////////////////
	
	Route::get('webcars', 'Backend\ProductsImagesController@index');
	Route::get('webcars/data', 'Backend\ProductsImagesController@data');
	Route::post('webcars/add', 'Backend\ProductsImagesController@add');
	Route::post('webcars/delete_image/{id}', 'Backend\ProductsImagesController@delete_image');
	Route::post('webcars/show', 'Backend\ProductsImagesController@show_edit_form');
	Route::post('webcars/update', 'Backend\ProductsImagesController@update');
	Route::post('webcars/delete', 'Backend\ProductsImagesController@delete');


	
	Route::get('export-cars', 'Backend\ExportProductsController@index');
	Route::get('export-cars/data', 'Backend\ExportProductsController@data');
	Route::post('export-cars/add', 'Backend\ExportProductsController@add');
	Route::post('export-cars/delete_image/{id}', 'Backend\ExportProductsController@delete_image');
	Route::post('export-cars/show', 'Backend\ExportProductsController@show_edit_form');
	Route::post('export-cars/update', 'Backend\ExportProductsController@update');
	Route::post('export-cars/delete', 'Backend\ExportProductsController@delete');
	Route::post('export-cars/change_status', 'Backend\ExportProductsController@change_status');
	////////////////////////////////////////////////
	
	Route::get('webexportcars', 'Backend\ExportProductsImagesController@index');
	Route::get('webexportcars/data', 'Backend\ExportProductsImagesController@data');
	Route::post('webexportcars/add', 'Backend\ExportProductsImagesController@add');
	Route::post('webexportcars/delete_image/{id}', 'Backend\ExportProductsImagesController@delete_image');
	Route::post('webexportcars/show', 'Backend\ExportProductsImagesController@show_edit_form');
	Route::post('webexportcars/update', 'Backend\ExportProductsImagesController@update');
	Route::post('webexportcars/delete', 'Backend\ExportProductsImagesController@delete');
	
	Route::get('exports', 'Backend\ExportsController@index');
	Route::get('exports/data', 'Backend\ExportsController@data');
	Route::post('exports/show', 'Backend\ExportsController@show_edit_form');
	Route::post('exports/change_status', 'Backend\ExportsController@change_status');
	
	

	Route::get('services', 'Backend\ExportServicesController@index');
	Route::get('services/data', 'Backend\ExportServicesController@data');
	Route::post('services/add', 'Backend\ExportServicesController@add');
	Route::post('services/show', 'Backend\ExportServicesController@show_edit_form');
	Route::post('services/update', 'Backend\ExportServicesController@update');
	Route::post('services/delete', 'Backend\ExportServicesController@delete');
	Route::post('services/change_status', 'Backend\ExportServicesController@change_status');

	//////////////////////////////////////////////////////////////

});
