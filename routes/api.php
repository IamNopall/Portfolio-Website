<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('upload-media', [ProjectController::class, 'uploadMedia']);
Route::post('projects/batch-delete', [ProjectController::class, 'batchDestroy']);
Route::apiResource('projects', ProjectController::class);
