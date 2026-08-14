<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::apiResource('projects', ProjectController::class);
