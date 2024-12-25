<?php
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::post('/users', [UserController::class, 'store']);
Route::post('/full-register', [UserController::class, 'createFullUser']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users-address', [UserController::class, 'indexFullUser']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users-address/{user}', [UserController::class, 'showFullUser']);;
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::put('/users-address/{user}', [UserController::class, 'updateFullUser']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::delete('/users-address/{user}', [UserController::class, 'destroyFullUser']);
    Route::get('/users-addresses-filter', [UserController::class, 'filter']);
    
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::get('/addresses/{address}', [AddressController::class, 'show']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::put('/addresses/{address}', [AddressController::class, 'update']);
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);

    Route::get('/admins', [AdminController::class, 'index']);
    Route::get('/admins/{admin}', [AdminController::class, 'show']);
    Route::post('/admins', [AdminController::class, 'store']);
    Route::put('/admins/{admin}', [AdminController::class, 'update']);
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy']);
});