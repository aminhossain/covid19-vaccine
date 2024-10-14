<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaccineCenterController;
use App\Http\Controllers\SearchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/vaccine-centers', [VaccineCenterController::class, 'index']);
Route::get('/search', [SearchController::class, 'searchByNID']);