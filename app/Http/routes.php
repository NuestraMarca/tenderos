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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'Dashboard\DashboardController@admin']);
    Route::post('message', ['as' => 'message', 'uses' => 'Dashboard\DashboardController@postMessage']);
    
    Route::controller('products', 'Shopkeeper\ProductsController');
    Route::controller('productions', 'Producer\ProductionsController');
    Route::controller('services', 'Services\ServicesController');

    Route::group(['middleware' => ['user_type:admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    	Route::resource('categories', 'CategoriesController');
    	Route::resource('categories.products', 'CategoriesProductsController');
	});
});

Route::get('juan', ['uses' => 'JuanController@holamundo']);



