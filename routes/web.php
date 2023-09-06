<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ELibraryController;
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
// Route::post('api-login', [AuthController::class, 'login'])->name('login.login');

Route::get('dashboard', [AuthController::class, 'dashboard']);
// Route::get('/', [AuthController::class, 'dashboard']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/api-logout', [AuthController::class, 'api_logout'])->name('api_logout.logout');


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

        //E-Library
        Route::get('/e-libraries',[ELibraryController::class, 'front_index'])->name('e-libraries.front_index');
        Route::get('/e-libraries-datatables',[ELibraryController::class, 'front_getDataTable'])->name('e-libraries.front_getDataTable');
        Route::get('/e-libraries/{id}/read',[ELibraryController::class, 'read'])->name('e-libraries.read');
        Route::get('/api-e-libraries',[ELibraryController::class, 'getJsonEbook'])->name('e-libraries.getJsonEbook');
        Route::get('/api-popular-e-libraries',[ELibraryController::class, 'getJsonPopularEbook'])->name('e-libraries.getJsonPopularEbook');
        Route::get('/api-new-e-libraries',[ELibraryController::class, 'getJsonNewEbook'])->name('e-libraries.getJsonNewEbook');
        Route::get('/api-upload-e-libraries',[ELibraryController::class, 'getJsonUploadEbook'])->name('e-libraries.getJsonUploadEbook');
        Route::get('/e-libraries/{id}/api',[ELibraryController::class, 'api_read'])->name('e-libraries.api_read');
        Route::get('/e-libraries/save-favorite',[ELibraryController::class, 'api_favorite'])->name('e-libraries.api_favorite');
        Route::get('/e-libraries/get-favorite',[ELibraryController::class, 'get_favorite'])->name('e-libraries.get_favorite');

    //E-Library Author
    Route::get('/author','AuthorController@index')->name('author.index');
    Route::get('/author-list','AuthorController@getDataTable')->name('author.getDataTable');
    Route::get('/author/create','AuthorController@showCreate')->name('author.create');
    Route::post('/author-store','AuthorController@store')->name('author.store');
    Route::get('/author/edit','AuthorController@edit')->name('author.edit');
    Route::post('/author/update','AuthorController@update')->name('author.update');
    Route::get('/author/{id}/delete','AuthorController@destroy')->name('author.delete');
    Route::get('/author/{id}/show','AuthorController@show')->name('author.show');
    Route::get('/author/{id}/history','AuthorController@show_history_detail')->name('author.show_detail');
    Route::get('/author-history','AuthorController@show_history')->name('authors-history.getDatatable');
    
    Route::get('/author-list-to','AuthorController@authors')->name('author.list');
    Route::get('/author-list-to-branch','AuthorController@authors_branch')->name('author.authors_branch');

    //E-Library Publisher
    Route::get('/publisher','PublisherController@index')->name('publisher.index');
    Route::get('/publisher-list','PublisherController@getDataTable')->name('publisher.getDataTable');
    Route::get('/publisher/create','PublisherController@showCreate')->name('publisher.create');
    Route::post('/publisher-store','PublisherController@store')->name('publisher.store');
    Route::get('/publisher/edit','PublisherController@edit')->name('publisher.edit');
    Route::post('/publisher/update','PublisherController@update')->name('publisher.update');
    Route::get('/publisher/{id}/delete','PublisherController@destroy')->name('publisher.delete');
    Route::get('/publisher/{id}/show','PublisherController@show')->name('publisher.show');
    Route::get('/publisher/{id}/history','PublisherController@show_history_detail')->name('publisher.show_detail');
    Route::get('/publisher-history','PublisherController@show_history')->name('publishers-history.getDatatable');
    
    Route::get('/publisher-list-to','PublisherController@publishers')->name('publisher.list');
    Route::get('/publisher-list-to-branch','PublisherController@publishers_branch')->name('publisher.publishers_branch');

    //E-Library Genre
    Route::get('/genre','GenreController@index')->name('genre.index');
    Route::get('/genre-list','GenreController@getDataTable')->name('genre.getDataTable');
    Route::get('/genre/create','GenreController@showCreate')->name('genre.create');
    Route::post('/genre-store','GenreController@store')->name('genre.store');
    Route::get('/genre/edit','GenreController@edit')->name('genre.edit');
    Route::post('/genre/update','GenreController@update')->name('genre.update');
    Route::get('/genre/{id}/delete','GenreController@destroy')->name('genre.delete');
    Route::get('/genre/{id}/show','GenreController@show')->name('genre.show');
    Route::get('/genre/{id}/history','GenreController@show_history_detail')->name('genre.show_detail');
    Route::get('/genre-history','GenreController@show_history')->name('genres-history.getDatatable');
    
    Route::get('/genre-list-to','GenreController@genres')->name('genre.list');
    Route::get('/genre-list-to-branch','GenreController@genres_branch')->name('genre.genres_branch');

    //E-Library
    Route::get('/e-library','ELibraryController@index')->name('e-library.index');
    Route::get('/e-library-datatable','ELibraryController@getDatatable')->name('e-library.getDatatable');
    Route::get('/e-library/create','ELibraryController@create')->name('e-library.create');
    Route::post('/e-library','ELibraryController@store')->name('e-library.store');
    Route::get('/e-library/{id}/edit','ELibraryController@edit')->name('e-library.edit');
    Route::get('/e-library/{id}/delete','ELibraryController@destroy')->name('e-library.destroy');
    Route::put('/e-library/{id}','ELibraryController@update')->name('e-library.update');
    Route::get('/e-library/{id}/show','ELibraryController@show')->name('e-library.show');
    Route::get('/e-library/{id}/history','ELibraryController@show_history_detail')->name('e-library.show_detail');
    Route::get('/e-library-history','ELibraryController@show_history')->name('e-library-history.getDatatable');
    Route::get('/e-library/{id}/download','ELibraryController@download')->name('e-library.download');
    Route::get('/e-library-history/{id}/download','ELibraryController@history_download')->name('e-library.history_download');

    Route::get('/e-library-list','ELibraryController@bookouts')->name('e-library.list');


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
