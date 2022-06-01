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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers'], function()
{

    /**
     * User Routes
     */
    Route::group(['prefix' => 'departments'], function() {
        Route::get('/', 'DepartmentController@index')->name('departments.index');
        Route::get('/create', 'DepartmentController@create')->name('departments.create');
        Route::post('/create', 'DepartmentController@store')->name('departments.store');
        Route::get('/{id}/show', 'DepartmentController@show')->name('departments.show');
        Route::get('/{id}/edit', 'DepartmentController@edit')->name('departments.edit');
        Route::patch('/{id}/update', 'DepartmentController@update')->name('departments.update');
        Route::delete('/{id}/delete', 'DepartmentController@destroy')->name('departments.destroy');
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
        Route::delete('deleteAll', 'UserController@deleteAll')->name('users.deleteAll');;
    });
});
