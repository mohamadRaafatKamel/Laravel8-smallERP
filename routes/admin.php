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

    /*
    Route::get('getnotification', 'DashboardController@notificationShow');
    Route::get('savetoken', 'DashboardController@saveToken')->name('save.token');

    ##################### Specialty ############################
    Route::group(['prefix'=>'specialty'],function (){
        Route::get('/','SpecialtyController@index')->name('admin.specialty');
        Route::get('create','SpecialtyController@create')->name('admin.specialty.create');
        Route::post('store','SpecialtyController@store')->name('admin.specialty.store');

        Route::get('edit/{id}','SpecialtyController@edit')->name('admin.specialty.edit');
        Route::post('update/{id}','SpecialtyController@update')->name('admin.specialty.update');

        Route::get('delete/{id}','SpecialtyController@destroy') -> name('admin.specialty.delete');
    });
    ##################### End Specialty ########################

    ##################### Category ############################
    Route::group(['prefix'=>'category'],function (){
        Route::get('/','CategoryController@index')->name('admin.category');
        Route::get('create','CategoryController@create')->name('admin.category.create');
        Route::post('store','CategoryController@store')->name('admin.category.store');

        Route::get('import','CategoryController@import')->name('admin.category.import');
        Route::post('importstore','CategoryController@importstore')->name('admin.category.importstore');

        Route::get('edit/{id}','CategoryController@edit')->name('admin.category.edit');
        Route::post('update/{id}','CategoryController@update')->name('admin.category.update');

        // Route::get('delete/{id}','CategoryController@destroy') -> name('admin.category.delete');
    });
    ##################### End Category ########################

    ##################### MedicalType ############################
    Route::group(['prefix'=>'medicaltype'],function (){
        Route::get('/','MedicalTypeController@index')->name('admin.medicaltype');
        Route::get('create','MedicalTypeController@create')->name('admin.medicaltype.create');
        Route::post('store','MedicalTypeController@store')->name('admin.medicaltype.store');

        Route::get('edit/{id}','MedicalTypeController@edit')->name('admin.medicaltype.edit');
        Route::post('update/{id}','MedicalTypeController@update')->name('admin.medicaltype.update');

        // Route::get('delete/{id}','MedicalTypeController@destroy') -> name('admin.medicaltype.delete');
    });
    ##################### End MedicalType ########################

    ##################### Service ############################
    Route::group(['prefix'=>'service'],function (){
        Route::get('/','ServiceController@index')->name('admin.service');
        Route::get('create','ServiceController@create')->name('admin.service.create');
        Route::post('store','ServiceController@store')->name('admin.service.store');

        Route::get('import','ServiceController@import')->name('admin.service.import');
        Route::post('importstore','ServiceController@importstore')->name('admin.service.importstore');

        Route::get('edit/{id}','ServiceController@edit')->name('admin.service.edit');
        Route::post('update/{id}','ServiceController@update')->name('admin.service.update');

        // Route::get('delete/{id}','ServiceController@destroy') -> name('admin.service.delete');
    });
    ##################### End Service ########################

    ##################### PriceList ############################
    Route::group(['prefix'=>'pricelist'],function (){
        Route::get('/','PriceListController@index')->name('admin.pricelist');
        Route::get('create','PriceListController@create')->name('admin.pricelist.create');
        Route::post('store','PriceListController@store')->name('admin.pricelist.store');

        Route::get('import','PriceListController@import')->name('admin.pricelist.import');
        Route::post('storeimport','PriceListController@importstore')->name('admin.pricelist.storeimport');

        Route::get('edit/{id}','PriceListController@edit')->name('admin.pricelist.edit');
        Route::post('update/{id}','PriceListController@update')->name('admin.pricelist.update');

        // ajax
        Route::post('/setroll', 'PriceListController@setRoll')->name('ajax.pricelist.set.roll');
        Route::post('/setservice', 'PriceListController@setService')->name('ajax.pricelist.set.service');
        // Route::post('/setpackage', 'PriceListController@setPackage')->name('ajax.pricelist.set.package');

        Route::get('delete/{plid}/{id}','PriceListController@destroyRoll') -> name('admin.pricelist.roll.delete');
        Route::get('deletesrv/{plid}/{id}','PriceListController@destroyService') -> name('admin.pricelist.service.delete');
    });
    ##################### End PriceList ########################

    ##################### Company ############################
    Route::group(['prefix'=>'company'],function (){
        Route::get('/','CompanyController@index')->name('admin.company');
        Route::get('create','CompanyController@create')->name('admin.company.create');
        Route::post('store','CompanyController@store')->name('admin.company.store');

        Route::get('edit/{id}','CompanyController@edit')->name('admin.company.edit');
        Route::post('update/{id}','CompanyController@update')->name('admin.company.update');

        Route::get('delete/{id}','CompanyController@destroy') -> name('admin.company.delete');
    });
    ##################### End Company ########################

    ##################### Package ############################
    Route::group(['prefix'=>'package'],function (){
        Route::get('/','PackageController@index')->name('admin.package');
        Route::get('create','PackageController@create')->name('admin.package.create');
        Route::post('store','PackageController@store')->name('admin.package.store');

        Route::get('edit/{id}','PackageController@edit')->name('admin.package.edit');
        Route::post('update/{id}','PackageController@update')->name('admin.package.update');

        //Route::get('delete/{id}','PackageController@destroy') -> name('admin.package.delete');
    });
    ##################### End Package ########################

    ##################### Physician ############################
    Route::group(['prefix'=>'physician'],function (){
        Route::get('/','PhysicianController@index')->name('admin.physician');
        Route::get('create','PhysicianController@create')->name('admin.physician.create');
        Route::post('store','PhysicianController@store')->name('admin.physician.store');

        Route::get('edit/{id}','PhysicianController@edit')->name('admin.physician.edit');
        Route::post('update/{id}','PhysicianController@update')->name('admin.physician.update');

    });
    ##################### End Physician ########################

    ##################### Referral ############################
    Route::group(['prefix'=>'referral'],function (){
        Route::get('/','ReferralController@index')->name('admin.referral');
        Route::get('create','ReferralController@create')->name('admin.referral.create');
        Route::post('store','ReferralController@store')->name('admin.referral.store');

        Route::get('edit/{id}','ReferralController@edit')->name('admin.referral.edit');
        Route::post('update/{id}','ReferralController@update')->name('admin.referral.update');

        // Category
        Route::get('ref/cat','ReferralController@refCat')->name('admin.referral.cat');
        Route::post('ref/cat/store','ReferralController@refCatStore')->name('admin.referral.cat.store');
        Route::get('ref/cat/delete/{id}','ReferralController@refCatDelete')->name('admin.referral.cat.delete');

        // Route::get('delete/{id}','ReferralController@destroy') -> name('admin.referral.delete');
    });
    ##################### End Referral ########################

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

    ##################### Role ###############################
    Route::group(['prefix'=>'role'],function (){
        Route::get('/','RoleController@index')->name('admin.role');
        Route::get('create','RoleController@create')->name('admin.role.create');
        Route::post('store','RoleController@store')->name('admin.role.store');

        Route::get('edit/{id}','RoleController@edit')->name('admin.role.edit');
        Route::post('update/{id}','RoleController@update')->name('admin.role.update');

        Route::get('delete/{id}','RoleController@destroy') -> name('admin.role.delete');
    });
    ##################### End Role ###########################

    ##################### Setting ###############################
    Route::group(['prefix'=>'setting'],function (){

        Route::get('/','SettingController@create')->name('admin.setting');
        Route::post('update','SettingController@update')->name('admin.setting.update');

    });
    ##################### End Setting ###########################

    ##################### Survay ###############################
    Route::group(['prefix'=>'survey'],function (){

        Route::get('/','WebSurvayController@index')->name('admin.survay');
        Route::get('/statistics','WebSurvayController@statistics')->name('admin.statistics');

    });
    ##################### End Survay ###########################

    ##################### Users ##############################
    Route::group(['prefix'=>'user'],function (){
        Route::get('/','UserController@index')->name('admin.user');
        Route::get('/patent','UserController@indexPatent')->name('admin.user.patent');
        Route::get('/doctor','UserController@indexDoctor')->name('admin.user.doctor');
        Route::get('/nurse','UserController@indexNurse')->name('admin.user.nurse');
        Route::get('/driver','UserController@indexDriver')->name('admin.user.driver');
        
       Route::get('create','UserController@create')->name('admin.user.create');
       Route::post('store','UserController@store')->name('admin.user.store');

        Route::get('view/{id}','UserController@view')->name('admin.user.view');
        Route::post('update/{id}','UserController@update')->name('admin.user.update');

        Route::get('type/{id}/{type}','UserController@type')->name('admin.user.type');

//        Route::get('delete/{id}','AdminController@destroy') -> name('admin.user.delete');
    });
    ##################### End Users ##########################

    ##################### Request ##############################
    Route::group(['prefix'=>'request'],function (){
        // cc
        Route::get('/','RequestController@indexCC')->name('admin.request.cc');
        Route::get('/cc/create','RequestController@createCC')->name('admin.request.create.cc');
        Route::get('/cc/status/{id}/{status}','RequestController@statusCC')->name('admin.request.status.cc');
        Route::post('store','RequestController@store')->name('admin.request.store');
        Route::post('update/{id}','RequestController@update')->name('admin.request.update');
        
        // Emergency
        Route::get('/emergency','RequestController@indexEm')->name('admin.request.emergency');
        Route::get('/em/create','RequestController@createEM')->name('admin.request.create.em');
        Route::post('/em/store','RequestController@storeEM')->name('admin.request.store.em');
        Route::post('/em/update/{id}','RequestController@updateEM')->name('admin.request.update.em');

        // in
        Route::get('/in','RequestController@indexIN')->name('admin.request.in');
        Route::get('/in/create/{id}','RequestController@createIN')->name('admin.request.create.in');
        Route::post('/in/update/{id}','RequestController@updateIN')->name('admin.request.update.in');
        // Route::get('/in/status/{id}/{status}','RequestController@statusIN')->name('admin.request.status.in');

        // out
        Route::get('/out','RequestController@indexOut')->name('admin.request.out');
        Route::get('/out/create/{id}','RequestController@createOut')->name('admin.request.create.out');
        Route::post('/out/update/{id}','RequestController@updateOut')->name('admin.request.update.out');
        // Route::get('/out/status/{id}/{status}','RequestController@statusIN')->name('admin.request.status.in');

        // Lab
        Route::get('/lab','RequestController@indexLab')->name('admin.request.lab');
        Route::get('/lab/create/{id}','RequestController@createLab')->name('admin.request.create.lab');
        Route::post('/lab/update/{id}','RequestController@updateLab')->name('admin.request.update.lab');
        
//        Route::get('view/{id}','RequestController@view')->name('admin.user.view');
//        Route::post('update/{id}','RequestController@update')->name('admin.user.update');

        // Call
        Route::get('/call/delete/{id}','RequestController@destroyCall') -> name('admin.call.delete');

        // Action
        Route::get('/action/delete/{id}','RequestController@destroyAction') -> name('admin.action.delete');

        // Nurse Sheet
        Route::post('/sheet/store/{id}','RequestController@storeSheet')->name('admin.sheet.store');
        Route::get('/sheet/delete/{id}','RequestController@destroySheet') -> name('admin.sheet.delete');

        // ajax
        Route::get('/getUserInfo/{id}', 'RequestController@getUserInfo');
        Route::post('/getServPrice', 'RequestController@getServPric')->name('ajax.service.get.price');
        Route::post('/getPackagePrice', 'RequestController@getPackagePrice')->name('ajax.package.get.price');
        Route::get('/getCityGevern/{id}', 'RequestController@getCityGevern');
        
    });
    ##################### End Request ##########################

    ##################### Report ###############################
    Route::group(['prefix'=>'report'],function (){

        Route::get('/out','ReportController@indexOut')->name('admin.report.out');

    });
    ##################### End Report ###########################

     ##################### Order ##############################
    //  Route::group(['prefix'=>'order'],function (){
    //     Route::get('/','OrderController@index')->name('admin.order');

        

        
    //     Route::get('/getDocSpecialty/{id}', 'OrderController@getDocSpecialty');

//        Route::get('edit/{id}','OrderController@edit')->name('admin.order.edit');
//        Route::post('update/{id}','OrderController@update')->name('admin.order.update');
//
//        Route::get('delete/{id}','OrderController@destroy') -> name('admin.order.delete');
    // });
    ##################### End Order ##########################

    ##################### Notification ##############################
    // Route::get('/getcountreqest/{type}', 'HomeController@getCountReqest');

    ##################### End Notification ##########################
*/
});


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'guest:admin'],function (){

    Route::get('login', 'LoginController@getLogin')->name('admin.getlogin');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();

