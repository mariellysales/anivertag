<?php
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/addresses', [AddressController::class, 'index']);

Route::get('/addresses/{address}', [AddressController::class, 'show']);

Route::get('/admins', [AdminController::class, 'index']);

Route::get('/admins/{admin}', [AdminController::class, 'show']);