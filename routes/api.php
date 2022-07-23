<?php

use App\Http\Controllers\Api\TypeUserController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'list'])->name('users.list');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
});
Route::prefix('deleted')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'listDeleted'])->name('users.deleted.list');
        Route::put('/{id}', [UserController::class, 'restore'])->name('users.deleted.restore');
        Route::put('/', [UserController::class, 'restoreAll'])->name('users.deleted.restoreAll');
    });
});
Route::prefix('type_users')->group(function () {
    Route::get('/', [TypeUserController::class, 'list'])->name('type_users.list');
    Route::post('/', [TypeUserController::class, 'store'])->name('type_users.store');
    Route::get('/{id}', [TypeUserController::class, 'show'])->name('type_users.show');
});
