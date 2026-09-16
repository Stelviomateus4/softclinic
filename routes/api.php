<?php

use App\Http\Controllers\DoctorApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');

Route::get('/days/{id}', [DoctorApiController::class, 'getDays']);
