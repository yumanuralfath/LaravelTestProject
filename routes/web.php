<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

Route::get('/', [TodoController::class, 'showTodos']);
Route::post('/todos', [TodoController::class, 'createFromBlade'])->name('todos.create');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
Route::delete('/todos/{todo}', [TodoController::class, 'deleteBlade'])->name('todos.delete');