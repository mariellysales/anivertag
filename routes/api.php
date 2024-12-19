<?php
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

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