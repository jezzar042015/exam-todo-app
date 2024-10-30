<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tasks',[]);
Route::get('/tasks/{id}',[]);
Route::post('/tasks',[]);
Route::put('/tasks/{id}',[]);
Route::delete('/tasks/{id}',[]);
