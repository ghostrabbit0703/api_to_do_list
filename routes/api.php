<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;


// Categories
Route::apiResource('categories', CategoryController::class);


// Tags
Route::apiResource('tags', TagController::class);


// Tasks
Route::apiResource('tasks', TaskController::class);


// Toggle task completed
Route::patch(
    'tasks/{task}/toggle-completed',
    [TaskController::class, 'toggleCompleted']
);
/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */
