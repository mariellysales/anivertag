<?php
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);

Route::get('/addresses', [AddressController::class, 'index']);
