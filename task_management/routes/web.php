<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create')->middleware('permission:create task');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store')->middleware('permission:create task');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit')->middleware('permission:update task');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update')->middleware('permission:update task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('permission:destroy task');
});

require __DIR__ . '/auth.php';
