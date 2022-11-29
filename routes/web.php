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
        Route::post('/getDepartmentByCompanyId', 'SuperAdmin\UserController@getDepartmentByCompanyId')->name('super-admin.users.getDepartmentByCompanyId');

        Route::post('/create', 'SuperAdmin\UserController@store')->name('super-admin.users.store');
        Route::get('/{id}/show', 'SuperAdmin\UserController@show')->name('super-admin.users.show');
        Route::get('/{id}/edit', 'SuperAdmin\UserController@edit')->name('super-admin.users.edit');
        Route::patch('/{id}/update', 'SuperAdmin\UserController@update')->name('super-admin.users.update');
        Route::delete('/{id}/delete', 'SuperAdmin\UserController@destroy')->name('super-admin.users.destroy');
        Route::delete('changeStatus', 'SuperAdmin\UserController@changeStatus')->name('super-admin.users.changeStatus');
        Route::delete('deleteAll', 'SuperAdmin\UserController@deleteAll')->name('super-admin.users.deleteAll');;




    });



    Route::group(['prefix' => 'super-admin/companies'], function() {
        Route::get('/', 'SuperAdmin\CompanyController@index')->name('super-admin.companies.index');
        Route::get('/create', 'SuperAdmin\CompanyController@create')->name('super-admin.companies.create');
        Route::post('/create', 'SuperAdmin\CompanyController@store')->name('super-admin.companies.store');
        Route::get('/{id}/show', 'SuperAdmin\CompanyController@show')->name('super-admin.companies.show');
        Route::get('/{id}/edit', 'SuperAdmin\CompanyController@edit')->name('super-admin.companies.edit');
        Route::patch('/{id}/update', 'SuperAdmin\CompanyController@update')->name('super-admin.companies.update');
        Route::delete('/{id}/delete', 'SuperAdmin\CompanyController@destroy')->name('super-admin.companies.destroy');
        Route::delete('changeStatus', 'SuperAdmin\CompanyController@changeStatus')->name('super-admin.companies.changeStatus');
        Route::delete('deleteAll', 'SuperAdmin\CompanyController@deleteAll')->name('super-admin.companies.deleteAll');;
    });


    /**
     * Department Admin Routes
     */
    Route::group(['prefix' => 'admin/departments'], function() {
        Route::get('/', 'Admin\DepartmentController@index')->name('admin.departments.index');
        Route::get('/create', 'Admin\DepartmentController@create')->name('admin.departments.create');
        Route::post('/create', 'Admin\DepartmentController@store')->name('admin.departments.store');
        Route::get('/{id}/show', 'Admin\DepartmentController@show')->name('admin.admin.departments.show');
        Route::get('/{id}/edit', 'Admin\DepartmentController@edit')->name('admin.departments.edit');
        Route::patch('/{id}/update', 'Admin\DepartmentController@update')->name('admin.departments.update');
        Route::delete('/{id}/delete', 'Admin\DepartmentController@destroy')->name('admin.departments.destroy');
        Route::delete('changeStatus', 'Admin\DepartmentController@changeStatus')->name('admin.departments.changeStatus');
        Route::delete('deleteAll', 'Admin\DepartmentController@deleteAll')->name('admin.departments.deleteAll');;
    });

    Route::group(['prefix' => 'admin/teams'], function() {
        Route::get('/', 'Admin\TeamController@index')->name('admin.teams.index');
        Route::get('/create', 'Admin\TeamController@create')->name('admin.teams.create');
        Route::post('/create', 'Admin\TeamController@store')->name('admin.teams.store');
        Route::get('/{id}/show', 'Admin\TeamController@show')->name('admin.teams.show');
        Route::get('/{id}/edit', 'Admin\TeamController@edit')->name('admin.teams.edit');
        Route::patch('/{id}/update', 'Admin\TeamController@update')->name('admin.teams.update');
        Route::delete('/{id}/delete', 'Admin\TeamController@destroy')->name('admin.teams.destroy');
        Route::delete('/changeStatus', 'Admin\TeamController@changeStatus')->name('admin.teams.changeStatus');
        Route::delete('/deleteAll', 'Admin\TeamController@deleteAll')->name('admin.teams.deleteAll');;
        Route::get('/autocomplete-search','Admin\TeamController@autocompleteSearch')->name('admin.teams.autocompleteSearch');
    });


    Route::group(['prefix' => 'admin/leads'], function() {
        Route::get('/', 'Admin\LeadController@index')->name('admin.leads.index');
        Route::get('/create', 'Admin\LeadController@create')->name('admin.leads.create');
        Route::post('/create', 'Admin\LeadController@store')->name('admin.leads.store');
        Route::post('/getDepartmentByCompanyId', 'Admin\LeadController@getLeadTypeCategoriesByLeadTypeId')->name('admin.leads.getLeadTypeCategoriesByLeadTypeId');
        Route::get('/{id}/show', 'Admin\LeadController@show')->name('admin.leads.show');
        Route::get('/{id}/edit', 'Admin\LeadController@edit')->name('admin.leads.edit');
        Route::post('/{id}/update', 'Admin\LeadController@update')->name('admin.leads.update');
        Route::delete('/{id}/delete', 'Admin\LeadController@destroy')->name('admin.leads.destroy');
        Route::delete('/changeStatus', 'Admin\LeadController@changeStatus')->name('admin.leads.changeStatus');
        Route::delete('/deleteAll', 'Admin\LeadController@deleteAll')->name('admin.leads.deleteAll');;
        Route::get('/{id}/meeting', 'Admin\LeadController@meeting')->name('admin.leads.meeting');
        Route::post('/{id}/store-meeting', 'Admin\LeadController@storeMeeting')->name('admin.leads.store-meeting');
        Route::post('/upload-lead-attachments','Admin\LeadController@uploadLeadAttachments')->name('admin.leads.upload-lead-attachments');;
         Route::delete('/remove-lead-attachment','Admin\LeadController@removeLeadAttachment')->name('admin.leads.remove-lead-attachment');



        //  Route::get('/autocomplete-search','Admin\LeadController@autocompleteSearch')->name('admin.leads.autocompleteSearch');
    });




    Route::group(['prefix' => 'admin/team-targets'], function() {
        Route::get('/', 'Admin\TeamTargetController@index')->name('admin.team-targets.index');
        Route::get('/create', 'Admin\TeamTargetController@create')->name('admin.team-targets.create');
        Route::post('/create', 'Admin\TeamTargetController@store')->name('admin.team-targets.store');
        Route::get('/{id}/show', 'Admin\TeamTargetController@show')->name('admin.team-targets.show');
        Route::get('/{id}/edit', 'Admin\TeamTargetController@edit')->name('admin.team-targets.edit');
        Route::patch('/{id}/update', 'Admin\TeamTargetController@update')->name('admin.team-targets.update');
        Route::delete('/{id}/delete', 'Admin\TeamTargetController@destroy')->name('admin.team-targets.destroy');
        Route::delete('/changeStatus', 'Admin\TeamTargetController@changeStatus')->name('admin.team-targets.changeStatus');
        Route::delete('/deleteAll', 'Admin\TeamTargetController@deleteAll')->name('admin.team-targets.deleteAll');
    });



    Route::group(['prefix' => 'leads'], function() {
        Route::get('/', 'LeadController@index')->name('leads.index');
        Route::get('/create', 'LeadController@create')->name('leads.create');
        Route::post('/create', 'LeadController@store')->name('leads.store');
        Route::post('/getDepartmentByCompanyId', 'LeadController@getLeadTypeCategoriesByLeadTypeId')->name('leads.getLeadTypeCategoriesByLeadTypeId');
        Route::get('/{id}/show', 'LeadController@show')->name('leads.show');
        Route::get('/{id}/edit', 'LeadController@edit')->name('leads.edit');
        Route::patch('/{id}/update', 'LeadController@update')->name('leads.update');
        Route::delete('/{id}/delete', 'LeadController@destroy')->name('leads.destroy');
        Route::delete('/changeStatus', 'LeadController@changeStatus')->name('leads.changeStatus');
        Route::delete('/deleteAll', 'LeadController@deleteAll')->name('leads.deleteAll');;
        Route::get('/{id}/meeting', 'LeadController@meeting')->name('leads.meeting');
        Route::post('/{id}/store-meeting', 'LeadController@storeMeeting')->name('leads.store-meeting');
        //  Route::get('/autocomplete-search','Admin\LeadController@autocompleteSearch')->name('admin.leads.autocompleteSearch');
    });



});
