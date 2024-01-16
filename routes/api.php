<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ELibraryController;
use App\Http\Controllers\TodoCategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('api_login.login');
Route::post('/logout', [AuthController::class, 'api_logout'])->name('api_logout.logout');
Route::post('/register', [AuthController::class, 'api_register'])->name('api_register.register');

Route::middleware('auth:sanctum')->group(function() {
  // E-Libraries
  Route::get('/api-e-libraries',[ELibraryController::class, 'getJsonEbook'])->name('e-libraries.getJsonEbook');
  Route::get('/api-popular-e-libraries',[ELibraryController::class, 'getJsonPopularEbook'])->name('e-libraries.getJsonPopularEbook');
  Route::get('/api-new-e-libraries',[ELibraryController::class, 'getJsonNewEbook'])->name('e-libraries.getJsonNewEbook');
  Route::get('/api-upload-e-libraries',[ELibraryController::class, 'getJsonUploadEbook'])->name('e-libraries.getJsonUploadEbook');
  Route::get('/api-authors',[ELibraryController::class, 'getJsonAuthor'])->name('e-libraries.getJsonAuthor');
  Route::get('/api-genres',[ELibraryController::class, 'getJsonGenre'])->name('e-libraries.getJsonGenre');
  Route::get('/e-libraries/{id}/api',[ELibraryController::class, 'api_read'])->name('e-libraries.api_read');
  Route::post('/e-libraries/save-favorite',[ELibraryController::class, 'api_favorite'])->name('e-libraries.api_favorite');
  Route::post('/e-libraries/get-favorite',[ELibraryController::class, 'get_favorite'])->name('e-libraries.get_favorite');
  Route::post('/e-libraries/get-author',[ELibraryController::class, 'get_books_by_author'])->name('e-libraries.get_books_by_author');
  Route::post('/e-libraries/get-genre',[ELibraryController::class, 'getBooksByGenre'])->name('e-libraries.getBooksByGenre');

  // Todo
  Route::get('/todos',[TodoController::class, 'getJsonAllTodos'])->name('todos.getJsonTodos');
  Route::post('/todos-category',[TodoController::class, 'getJsonCategoryTodos'])->name('todos.getJsonCategoryTodos');
  Route::get('/todos-deleted-todos',[TodoController::class, 'getJsonRecycleBin'])->name('todos.getJsonRecycleBin');
  Route::post('/todos-create',[TodoController::class, 'apiStore'])->name('todos.apiStore');
  Route::get('/todos-edit/{id}',[TodoController::class, 'apiEdit'])->name('todos.apiEdit');
  Route::post('/todos-update/{id}',[TodoController::class, 'apiUpdate'])->name('todos.apiUpdate');
  Route::post('/todos-delete/{id}',[TodoController::class, 'apiDelete'])->name('todos.apiDelete');

  // TodoCategory
  Route::get('/todo-categories',[TodoCategoryController::class, 'getJsonTodoCategories'])->name('todo-categories.getJsonTodoCategories');
  Route::post('/todo-categories-create',[TodoCategoryController::class, 'apiStore'])->name('todo-categories.apiStore');
  Route::get('/todo-categories-edit/{id}',[TodoCategoryController::class, 'apiEdit'])->name('todo-categories.apiEdit');
  Route::post('/todo-categories-update/{id}',[TodoCategoryController::class, 'apiUpdate'])->name('todo-categories.apiUpdate');
  Route::post('/todo-categories-delete/{id}',[TodoCategoryController::class, 'apiDelete'])->name('todo-categories.apiDelete');

  // User
  // Route::get('/user',[UserController::class, 'index'])->name('user.index');
  Route::get('/user/{id}',[UserController::class, 'showApi'])->name('user.showApi');
  // Route::post('/user',[UserController::class, 'store'])->name('user.store');
  Route::post('/user/{id}',[UserController::class, 'updateProfile'])->name('user.updateProfile');
  Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');

});
