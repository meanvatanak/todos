<?php

use Illuminate\Support\Facades\Artisan;
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

Route::group(['middleware'=> ['web']],function () {
    Route::get('/', function () {
        return view('frontend.index');
    });

});



Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('post-login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('dashboard', [AuthController::class, 'dashboard']);
// Route::get('/', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('registration', [AuthController::class, 'registration'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});


Route::group(['middleware'=> ['auth']],function () {
    Route::get('/homepage', function () {
        return view('home');
    });

    //Role
    Route::get('/role','RoleController@index')->name('role.index');
    Route::get('/role-datatable','RoleController@getDatatable')->name('role.getDatatable');
    Route::get('/role/create','RoleController@create')->name('role.create');
    Route::post('/role','RoleController@store')->name('role.store');
    Route::get('/role/{role}/edit','RoleController@edit')->name('role.edit');
    Route::put('/role/{role}','RoleController@update')->name('role.update');
    // Route::get('/role/{id}/delete','RoleController@deleteEdit')->name('role.deleteEdit');
    
    //user
    Route::get('/user','UserController@index')->name('user.index');
    Route::get('/user-datatable','UserController@getDatatable')->name('user.getDatatable');
    Route::get('/user/create','UserController@create')->name('user.create');
    Route::post('/user','UserController@store')->name('user.store');
    Route::get('/user/{user}/edit','UserController@edit')->name('user.edit');
    Route::get('/user/{id}/delete','UserController@destroy')->name('user.deleteEdit');
    Route::put('/user/{user}','UserController@update')->name('user.update');
    Route::get('/user/{post}','UserController@show')->name('user.show');
    Route::get('/roleDynamic','UserController@baseRoleUser');
    Route::get('/user/{user}/show','UserController@show')->name('user.show');
    Route::get('/user-history-datatable','UserController@HistoryGetDatatable')->name('user_history.getDatatable');
    Route::get('/user/{id}/history','UserController@history')->name('user.history');
    // Route::delete('/user/{post}','UserController@destroy')->name('user.destroy');
});