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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');

//'middleware' => 'auth'
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware'=>'auth'], function () {

    Route::get('no_permission','WelcomeController@butNoPermission');
    Route::get('/', 'WelcomeController@index');

    Route::resource('permission','PermissionController');


    Route::get('role/permission/{role}', 'RoleController@rolePermission')->name('role.permission')->middleware('permission:permission_role');
    Route::get('role/{role}/remove', 'RoleController@remove')->name('role.remove');
    Route::post('role/permission', 'RoleController@rolePermissionStore')->name('role.permission.store')->middleware('permission:permission_role');
    Route::resource('role','RoleController');


    Route::get('user/role/{user}', 'UserController@userRole')->name('user.role')->middleware('permission:role_user');
    Route::post('user/role', 'UserController@userRoleStore')->name('user.role.store')->middleware('permission:role_user');
    Route::get('user/{user}/avatar','UserController@avatar')->name('user.avatar');
    Route::post('user/{user}/avatar','UserController@avatarUpload')->name('user.avatarUpload');
    Route::get('user/change_my','UserController@changeMy')->name('user.change_my');
    Route::post('user/store_my','UserController@storeMy')->name('user.store_my');
    Route::resource('user','UserController');


});


//Route::get('category/index','CategoryController@index')->name('category.index');
Route::get('category/delete/{id}','CategoryController@destroy')->name('category.destroy');
//Route::get('category/create','CategoryController@create')->name('category.create');
Route::resource('category','CategoryController');


Route::get('materialin/index','MaterialInController@index')->name('materialin.index');
Route::get('materialin/create','MaterialInController@create')->name('materialin.create');
Route::post('materialin/store','MaterialInController@store')->name('materialin.store');
Route::get('materialin/xhsearch','MaterialInController@xhsearch')->name('materialin.xhsearch');

Route::get('materialout/index','MaterialOutController@index')->name('materialout.index');
Route::get('materialout/create/{id}','MaterialOutController@create')->name('materialout.create');
Route::post('materialout/store','MaterialOutController@store')->name('materialout.store');
Route::get('materialout/storage','MaterialOutController@storage')->name('materialout.storage');

Route::get('storage/index','StorageController@index')->name('storage.index');

Auth::routes();


