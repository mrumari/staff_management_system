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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth']
], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
});

Route::group([
    'prefix' => 'super-admin',
    'as' => 'super-admin.',
    'namespace' => 'SuperAdmin',
    'middleware' => ['auth']
], function () {
    Route::get('/', [App\Http\Controllers\SuperAdmin\HomeController::class, 'index'])->name('home');
//    Route::group(['prefix' => 'departments'], function() {
//        Route::get('/', 'DepartmentController@index')->name('departments.index');
//        Route::get('/create', 'DepartmentController@create')->name('departments.create');
//        Route::post('/create', 'DepartmentController@store')->name('departments.store');
//        Route::get('/{id}/show', 'DepartmentController@show')->name('departments.show');
//        Route::get('/{id}/edit', 'DepartmentController@edit')->name('departments.edit');
//        Route::patch('/{id}/update', 'DepartmentController@update')->name('departments.update');
//        Route::delete('/{id}/delete', 'DepartmentController@destroy')->name('departments.destroy');
//        Route::delete('changeStatus', 'DepartmentController@changeStatus')->name('departments.changeStatus');
//        Route::delete('deleteAll', 'DepartmentController@deleteAll')->name('departments.deleteAll');;
//    });
//
//    Route::group(['prefix' => 'users'], function() {
//        Route::get('/', 'SuperAdmin\UserController@index')->name('users.index');
//        Route::get('/create', 'SuperAdmin\UserController@create')->name('users.create');
//        Route::post('/create', 'SuperAdmin\UserController@store')->name('users.store');
//        Route::get('/{id}/show', 'SuperAdmin\UserController@show')->name('users.show');
//        Route::get('/{id}/edit', 'SuperAdmin\UserController@edit')->name('users.edit');
//        Route::patch('/{id}/update', 'SuperAdmin\UserController@update')->name('users.update');
//        Route::delete('/{id}/delete', 'SuperAdmin\UserController@destroy')->name('users.destroy');
//        Route::delete('changeStatus', 'SuperAdmin\UserController@changeStatus')->name('users.changeStatus');
//        Route::delete('deleteAll', 'SuperAdmin\UserController@deleteAll')->name('users.deleteAll');;
//    });

});

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers'], function()
{

    /**
     * Super Admin Routes
     */

    Route::group(['prefix' => 'super-admin/departments'], function() {
        Route::get('/', 'SuperAdmin\DepartmentController@index')->name('super-admin.departments.index');
        Route::get('/create', 'SuperAdmin\DepartmentController@create')->name('super-admin.departments.create');
        Route::post('/create', 'SuperAdmin\DepartmentController@store')->name('super-admin.departments.store');
        Route::get('/{id}/show', 'SuperAdmin\DepartmentController@show')->name('super-admin.departments.show');
        Route::get('/{id}/edit', 'SuperAdmin\DepartmentController@edit')->name('super-admin.departments.edit');
        Route::patch('/{id}/update', 'SuperAdmin\DepartmentController@update')->name('super-admin.departments.update');
        Route::delete('/{id}/delete', 'SuperAdmin\DepartmentController@destroy')->name('super-admin.departments.destroy');
        Route::delete('changeStatus', 'SuperAdmin\DepartmentController@changeStatus')->name('super-admin.departments.changeStatus');
        Route::delete('deleteAll', 'SuperAdmin\DepartmentController@deleteAll')->name('super-admin.departments.deleteAll');;
    });
//
    Route::group(['prefix' => 'super-admin/users'], function() {
        Route::get('/', 'SuperAdmin\UserController@index')->name('super-admin.users.index');
        Route::get('/create', 'SuperAdmin\UserController@create')->name('super-admin.users.create');
        Route::post('/create', 'SuperAdmin\UserController@store')->name('super-admin.users.store');
        Route::get('/{id}/show', 'SuperAdmin\UserController@show')->name('super-admin.users.show');
        Route::get('/{id}/edit', 'SuperAdmin\UserController@edit')->name('super-admin.users.edit');
        Route::patch('/{id}/update', 'SuperAdmin\UserController@update')->name('super-admin.users.update');
        Route::delete('/{id}/delete', 'SuperAdmin\UserController@destroy')->name('super-admin.users.destroy');
        Route::delete('changeStatus', 'SuperAdmin\UserController@changeStatus')->name('super-admin.users.changeStatus');
        Route::delete('deleteAll', 'SuperAdmin\UserController@deleteAll')->name('super-admin.users.deleteAll');;
    });


    /**
     * Department Admin Routes
     */
    Route::group(['prefix' => 'departments'], function() {
        Route::get('/', 'DepartmentController@index')->name('departments.index');
        Route::get('/create', 'DepartmentController@create')->name('departments.create');
        Route::post('/create', 'DepartmentController@store')->name('departments.store');
        Route::get('/{id}/show', 'DepartmentController@show')->name('departments.show');
        Route::get('/{id}/edit', 'DepartmentController@edit')->name('departments.edit');
        Route::patch('/{id}/update', 'DepartmentController@update')->name('departments.update');
        Route::delete('/{id}/delete', 'DepartmentController@destroy')->name('departments.destroy');
        Route::delete('changeStatus', 'DepartmentController@changeStatus')->name('departments.changeStatus');
        Route::delete('deleteAll', 'DepartmentController@deleteAll')->name('departments.deleteAll');;
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/create', 'UserController@create')->name('users.create');
        Route::post('/create', 'UserController@store')->name('users.store');
        Route::get('/{id}/show', 'UserController@show')->name('users.show');
        Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
        Route::patch('/{id}/update', 'UserController@update')->name('users.update');
        Route::delete('/{id}/delete', 'UserController@destroy')->name('users.destroy');
        Route::delete('changeStatus', 'UserController@changeStatus')->name('users.changeStatus');
        Route::delete('deleteAll', 'UserController@deleteAll')->name('users.deleteAll');;
    });





});
