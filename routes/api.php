<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\TypeUser\TypeUserController;
use App\Http\Controllers\Api\User\UserController;
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

Route::prefix('login')->group(function () {
    Route::post('/', [AuthController::class, 'login'])->name('login.login');
});

Route::prefix('account')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::put('/{code}', [UserController::class, 'activeAccount'])->name('users.active.account');
    Route::post('/resend-code', [UserController::class, 'resendCode'])->name('users.resend.account');
});

Route::prefix('users')->group(function () {
    Route::get('/my-profile', [UserController::class, 'index'])->name('users.my-profile');
    Route::get('/', [UserController::class, 'list'])->name('users.list');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete');
});

Route::group(['middleware' => ['auth.jwt']], function () {

    Route::group(['middleware' => ['auth.type.user:1']], function () {
        Route::prefix('deleted')->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'listDeleted'])->name('users.deleted.list');
                Route::put('/{id}', [UserController::class, 'restore'])->name('users.deleted.restore');
                Route::put('/', [UserController::class, 'restoreAll'])->name('users.deleted.restoreAll');
            });
        });
    });

    Route::group(['middleware' => ['auth.type.user:2']], function () {
    });

    Route::group(['middleware' => ['auth.type.user:1|2']], function () {
        Route::prefix('users')->group(function () {
            Route::get('/my-profile', [UserController::class, 'index'])->name('users.my-profile');
        });
    });

    Route::prefix('users')->group(function () {
        Route::get('/my-profile', [UserController::class, 'index'])->name('users.my-profile');
        Route::get('/', [UserController::class, 'list'])->name('users.list');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    Route::prefix('type_users')->group(function () {
        Route::get('/', [TypeUserController::class, 'list'])->name('type_users.list');
        Route::post('/', [TypeUserController::class, 'store'])->name('type_users.store');
        Route::get('/{id}', [TypeUserController::class, 'show'])->name('type_users.show');
    });
});
