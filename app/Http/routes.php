<?php

use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Tenderos\Events\TestPusherEvent;
use Tenderos\Entities\User;
use Tenderos\Entities\Session;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell LaravelAppUi the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/***** Auth *****/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/* App **/

Route::get('/', ['as' => 'home', 'uses' => 'Dashboard\DashboardController@index']);
Route::get('documentacion', ['as' => 'home', 'uses' => 'Dashboard\DashboardController@docs']);

Route::group(['prefix' => 'estadisticas'], function () {
    Route::get('/', ['as' => 'stats.home', 'uses' => 'Stats\StatsController@index']);
    Route::get('compra-de-tenderos', ['as' => 'stats.commune-shopping-count', 'uses' => 'Stats\StatsController@getCommuneCountShoppingStatistics']);
    Route::get('compra-de-productos', ['as' => 'stats.commune-shopping', 'uses' => 'Stats\StatsController@getCommuneShoppingStatistics']);
    Route::get('promedio-de-compras', ['as' => 'stats.commune-shopping-avg', 'uses' => 'Stats\StatsController@getCommuneAvgShoppingStatistics']);
    Route::get('por-comunas', ['as' => 'stats.communes', 'uses' => 'Stats\StatsController@getCommunesStatistics']);
});

Route::group(['prefix' => 'stats'], function () {
    Route::get('commune', ['as' => 'stats-commune', 'uses' => 'Services\ServicesController@getCommuneStatistics']);
    Route::get('commune/shopping/count', ['as' => 'stats-commune-shopping-count', 'uses' => 'Services\ServicesController@getCommuneCountShoppingStatistics']);
    Route::get('commune/shopping', ['as' => 'stats-commune-shopping', 'uses' => 'Services\ServicesController@getCommuneShoppingStatistics']);
    Route::get('commune/shopping/avg', ['as' => 'stats-commune-shopping-avg', 'uses' => 'Services\ServicesController@getCommuneAvgShoppingStatistics']);
    Route::get('communes', ['as' => 'stats-communes', 'uses' => 'Services\ServicesController@getCommunesStatistics']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'Dashboard\DashboardController@admin']);
    Route::post('message', ['as' => 'message', 'uses' => 'Dashboard\DashboardController@postMessage']);
    
    Route::controller('products', 'Shopkeeper\ProductsController');
    Route::controller('productions', 'Producer\ProductionsController');
    Route::controller('services', 'Services\ServicesController');
    
    Route::group(['middleware' => ['user_type:admin'], 'namespace' => 'Admin'], function () {
        
        Route::resource('tenderos', 'ShopkeepersController');
        Route::get('tenderos/{tenderos}/shopping', [
            'as' => 'tenderos.shopping', 
            'uses' => 'ShopkeepersController@shopping'
        ]);

        Route::resource('productores', 'ProducersController');
        Route::get('productores/{productores}/shopping', [
            'as' => 'productores.shopping', 
            'uses' => 'ProducersController@shopping'
        ]);

        Route::resource('categories', 'CategoriesController');
    	Route::resource('categories.products', 'CategoriesProductsController');
	});
});



