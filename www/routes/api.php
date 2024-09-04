<?php

use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);



// Bill
Route::get('/bills', [BillController::class, 'index']);
Route::get('/bills/{bill}', [BillController::class, 'show']);
Route::post('bills', [BillController::class, 'store']);
