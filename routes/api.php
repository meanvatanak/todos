<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ELibraryController;
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

Route::post('login', [AuthController::class, 'login'])->name('login.login');
Route::post('/logout', [AuthController::class, 'api_logout'])->name('api_logout.logout');

Route::middleware('auth:sanctum')->group(function() {
  // E-Libraries
  Route::get('/api-e-libraries',[ELibraryController::class, 'getJsonEbook'])->name('e-libraries.getJsonEbook');
  Route::get('/api-popular-e-libraries',[ELibraryController::class, 'getJsonPopularEbook'])->name('e-libraries.getJsonPopularEbook');
  Route::get('/api-new-e-libraries',[ELibraryController::class, 'getJsonNewEbook'])->name('e-libraries.getJsonNewEbook');
  Route::get('/api-upload-e-libraries',[ELibraryController::class, 'getJsonUploadEbook'])->name('e-libraries.getJsonUploadEbook');
  Route::get('/e-libraries/{id}/api',[ELibraryController::class, 'api_read'])->name('e-libraries.api_read');
  Route::post('/e-libraries/save-favorite',[ELibraryController::class, 'api_favorite'])->name('e-libraries.api_favorite');
  Route::post('/e-libraries/get-favorite',[ELibraryController::class, 'get_favorite'])->name('e-libraries.get_favorite');
  Route::post('/e-libraries/get-author',[ELibraryController::class, 'get_books_by_author'])->name('e-libraries.get_books_by_author');

});
