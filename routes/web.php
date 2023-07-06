<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::get('get-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('api-login', [AuthController::class, 'login'])->name('login.login');

Route::get('dashboard', [AuthController::class, 'dashboard']);
// Route::get('/', [AuthController::class, 'dashboard']);


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

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/api-logout', [AuthController::class, 'api_logout'])->name('logout.logout');

    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    // Route::get('/todos','TodoController@index')->name('todos.index');
    Route::get('/todos-json', [TodoController::class, 'getJson'])->name('todos-json.getJson');
    Route::get('/todos-datatable',[TodoController::class, 'getDatatable'])->name('todos.getDatatable');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::post('/todos-json', [TodoController::class, 'store_api'])->name('todos-json.store');
    Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::put('/todos-json/{id}', [TodoController::class, 'update_api'])->name('todos-json.update');
    Route::get('/todos/{id}/delete',[TodoController::class, 'destroy'])->name('todos.destroy');
    Route::get('/todos-json/{id}/delete',[TodoController::class, 'destroy_api'])->name('todos-json.destroy');

    //Role
    Route::get('/role',[RoleController::class, 'index'])->name('role.index');
    Route::get('/role-datatable',[RoleController::class, 'getDatatable'])->name('role.getDatatable');
    Route::get('/role/create',[RoleController::class, 'create'])->name('role.create');
    Route::post('/role',[RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit',[RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}',[RoleController::class, 'update'])->name('role.update');
    // Route::get('/role/{id}/delete',[RoleController::class, 'update'])->name('role.deleteEdit');
    
    //user
    Route::get('/user',[UserController::class, 'index'])->name('user.index');
    Route::get('/user-datatable',[UserController::class, 'getDatatable'])->name('user.getDatatable');
    Route::get('/user/create',[UserController::class, 'create'])->name('user.create');
    Route::post('/user',[UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit',[UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}/delete',[UserController::class, 'destroy'])->name('user.deleteEdit');
    Route::put('/user/{user}',[UserController::class, 'update'])->name('user.update');
    Route::get('/user/{post}',[UserController::class, 'show'])->name('user.show');
    Route::get('/roleDynamic',[UserController::class, 'baseRoleUser']);
    Route::get('/user/{user}/show',[UserController::class, 'show'])->name('user.show');
    Route::get('/user-history-datatable',[UserController::class, 'HistoryGetDatatable'])->name('user_history.getDatatable');
    Route::get('/user/{id}/history',[UserController::class, 'history'])->name('user.history');
    // Route::delete('/user/{post}',[UserController::class, 'destroy'])->name('user.destroy');
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
