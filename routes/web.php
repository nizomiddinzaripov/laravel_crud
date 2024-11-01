<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);
Route::get('complete-task/{id}', [TasksController::class, 'complete'])->name('tasks.complete');
