<?php

use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [TodosController::class, 'index'])->name('home');

// Create/Store
Route::get('/create', [TodosController::class, 'create'])->name('todo.create');
Route::post('/store', [TodosController::class, 'store'])->name('todo.store');

// Edit/Update
Route::get('/edit/{id}', [TodosController::class, 'edit'])->name('todo.edit');
Route::put('/edit/{id}', [TodosController::class, 'update'])->name('todo.update');

Route::get('/finish/{id}', [TodosController::class, 'finish'])->name('todo.finish');
Route::get('/destroy/{id}', [TodosController::class, 'destroy'])->name('todo.destroy');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
