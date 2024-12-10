<?php
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);

Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/addresses/{address}', [AddressController::class, 'show']);
Route::post('/addresses', [AddressController::class, 'store']);

Route::get('/admins', [AdminController::class, 'index']);
Route::get('/admins/{admin}', [AdminController::class, 'show']);
Route::post('/admins', [AdminController::class, 'store']);