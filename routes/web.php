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

/* Public Routes */
Route::group(['namespace' => 'Public'], function()
{
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');    

});


/* Admin Routes */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin']], function()
{
    Route::get('/', 'DashboardController@index')->name('admin dashboard');    
    Route::get('dashboard', 'DashboardController@index')->name('admin dashboard');

    Route::get('user/list', 'UserController@index')->name('user list');
    Route::get('user/add/{id?}', 'UserController@add')->name('user add')->where('id', '[0-9]+');
    Route::post('user/store', 'UserController@store')->name('user store');
    Route::get('user/delete/{id}', 'UserController@delete')->name('user delete')->where('id', '[0-9]+');

    Route::get('permission/list', 'PermissionController@index')->name('permission list');
    Route::get('permission/add/{id?}', 'PermissionController@add')->name('permission add')->where('id', '[0-9]+');
    Route::post('permission/store', 'PermissionController@store')->name('permission store');
    Route::get('permission/delete/{id}', 'PermissionController@delete')->name('permission delete')->where('id', '[0-9]+');

    Route::get('role/list', 'RoleController@index')->name('role list');
    Route::get('role/add/{id?}', 'RoleController@add')->name('role add')->where('id', '[0-9]+');
    Route::post('role/store', 'RoleController@store')->name('role store');
    Route::get('role/delete/{id}', 'RoleController@delete')->name('role delete')->where('id', '[0-9]+');

    Route::get('setting/list', 'SettingController@index')->name('setting list');
    Route::get('setting/add/{id?}', 'SettingController@add')->name('setting add')->where('id', '[0-9]+');
    Route::post('setting/store', 'SettingController@store')->name('setting store');
    Route::get('setting/delete/{id}', 'SettingController@delete')->name('setting delete')->where('id', '[0-9]+');

});


/* Front Login Routes */
Route::group(['namespace' => 'front'], function()
{
    Route::get('dashboard', function () {
        return 'Hello World this is front dashboard';
    })->name('front dashboard');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');