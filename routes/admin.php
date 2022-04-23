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
define('PAGINATION_COUNT',1000);

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'auth:admin'],function (){

    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','DashboardController@logout')->name('admin.logout');

    
    ##################### Unit ############################
    Route::group(['prefix'=>'unit'],function (){
        Route::get('/','UnitController@index')->name('admin.unit');
        Route::get('create','UnitController@create')->name('admin.unit.create');
        Route::post('store','UnitController@store')->name('admin.unit.store');

        Route::get('edit/{id}','UnitController@edit')->name('admin.unit.edit');
        Route::post('update/{id}','UnitController@update')->name('admin.unit.update');

        Route::get('delete/{id}','UnitController@destroy') -> name('admin.unit.delete');
    });
    ##################### End Unit ########################

    ##################### Supplier ############################
    Route::group(['prefix'=>'supplier'],function (){
        Route::get('/','SupplierController@index')->name('admin.supplier');
        Route::get('create','SupplierController@create')->name('admin.supplier.create');
        Route::post('store','SupplierController@store')->name('admin.supplier.store');

        Route::get('edit/{id}','SupplierController@edit')->name('admin.supplier.edit');
        Route::post('update/{id}','SupplierController@update')->name('admin.supplier.update');

        Route::get('delete/{id}','SupplierController@destroy') -> name('admin.supplier.delete');
    });
    ##################### End Supplier ########################

    ##################### Stock ############################
    Route::group(['prefix'=>'stock'],function (){
        Route::get('/','StockController@index')->name('admin.stock');
        Route::get('create','StockController@create')->name('admin.stock.create');
        Route::post('store','StockController@store')->name('admin.stock.store');

        Route::get('edit/{id}','StockController@edit')->name('admin.stock.edit');
        Route::post('update/{id}','StockController@update')->name('admin.stock.update');

        Route::get('delete/{id}','StockController@destroy') -> name('admin.stock.delete');
    });
    ##################### End Stock ########################

    ##################### Transfer ############################
    Route::group(['prefix'=>'transfer'],function (){
        Route::get('/','TransferController@index')->name('admin.transfer');
        Route::get('create','TransferController@create')->name('admin.transfer.create');
        Route::post('store','TransferController@store')->name('admin.transfer.store');

        Route::get('edit/{id}','TransferController@edit')->name('admin.transfer.edit');
        Route::post('update/{id}','TransferController@update')->name('admin.transfer.update');

        Route::get('delete/{id}','TransferController@destroy') -> name('admin.transfer.delete');
    });
    ##################### End Transfer ########################

    ##################### Clearance ############################
    Route::group(['prefix'=>'clearance'],function (){
        Route::get('/','ClearanceController@index')->name('admin.clearance');
        Route::get('create','ClearanceController@create')->name('admin.clearance.create');
        Route::post('store','ClearanceController@store')->name('admin.clearance.store');

        Route::get('edit/{id}','ClearanceController@edit')->name('admin.clearance.edit');
        Route::post('update/{id}','ClearanceController@update')->name('admin.clearance.update');

        Route::get('delete/{id}','ClearanceController@destroy') -> name('admin.clearance.delete');
    });
    ##################### End Clearance ########################

    ##################### Employ ############################
    Route::group(['prefix'=>'employ'],function (){
        Route::get('/','EmployController@index')->name('admin.employ');
        Route::get('create','EmployController@create')->name('admin.employ.create');
        Route::post('store','EmployController@store')->name('admin.employ.store');

        Route::get('edit/{id}','EmployController@edit')->name('admin.employ.edit');
        Route::post('update/{id}','EmployController@update')->name('admin.employ.update');

        Route::get('delete/{id}','EmployController@destroy') -> name('admin.employ.delete');
    });
    ##################### End Employ ########################

    ##################### Product ############################
    Route::group(['prefix'=>'product'],function (){
        Route::get('/','ProductController@index')->name('admin.product');
        Route::get('create','ProductController@create')->name('admin.product.create');
        Route::post('store','ProductController@store')->name('admin.product.store');

        Route::get('edit/{id}','ProductController@edit')->name('admin.product.edit');
        Route::post('update/{id}','ProductController@update')->name('admin.product.update');

        // ajax
        Route::post('/setbuy', 'ProductController@setBuy')->name('ajax.product.set.buy');
        Route::post('/deletebuy','ProductController@destroyProductBuy') -> name('admin.product.buy.delete');
    });
    ##################### End Product ########################

    ##################### Order ############################
    Route::group(['prefix'=>'order'],function (){
        Route::get('/','OrderController@index')->name('admin.order');
        Route::get('view/{id?}','OrderController@create')->name('admin.order.create');
        Route::post('store','OrderController@store')->name('admin.order.store');

        Route::get('receive/view/{id?}','OrderController@receiveView')->name('admin.order.receive.create');
        // Route::post('update/{id}','OrderController@update')->name('admin.order.update');

        // ajax  
        Route::post('/setinfo', 'OrderController@setOrderInfo')->name('ajax.order.set.info');
        Route::post('/set', 'OrderController@setOrder')->name('ajax.order.set');
        Route::post('/get/pro/cat', 'OrderController@getProductCat')->name('ajax.order.get.product.cat');
        Route::post('/get/pro/unit', 'OrderController@getProductUnit')->name('ajax.order.get.product.unit');
        Route::post('delete/info','OrderController@destroyOrderInfo') -> name('admin.order.info.delete');
    });
    ##################### End Order ########################

    ##################### Admin ##############################
    Route::group(['prefix'=>'admin'],function (){
        Route::get('/','AdminController@index')->name('admin.admin');
        Route::get('create','AdminController@create')->name('admin.admin.create');
        Route::post('store','AdminController@store')->name('admin.admin.store');

        Route::get('edit/{id}','AdminController@edit')->name('admin.admin.edit');
        Route::post('update/{id}','AdminController@update')->name('admin.admin.update');

        Route::get('delete/{id}','AdminController@destroy') -> name('admin.admin.delete');
    });
    ##################### End Admin ##########################

});


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'guest:admin'],function (){

    Route::get('login', 'LoginController@getLogin')->name('admin.getlogin');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();

