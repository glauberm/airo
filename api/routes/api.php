<?php

use App\Http\Controllers\AgeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);

Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::post('/refresh', [AuthenticationController::class, 'refresh']);

Route::get('/authenticated-user', [AuthenticationController::class, 'authenticatedUser']);

Route::post('/quotation', QuotationController::class);

Route::get('/ages', AgeController::class);

Route::get('/currencies', CurrencyController::class);
