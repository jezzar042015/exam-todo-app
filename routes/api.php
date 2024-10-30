<?php

use App\Http\Controllers\API\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::put('/tasks-status/{id}', [TasksController::class, 'updateStatus']);

Route::apiResource('tasks', TasksController::class);
