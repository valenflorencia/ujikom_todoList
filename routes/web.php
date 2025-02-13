<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;

// Membuat route untuk halaman utama
Route::get('/', [TaskController::class, 'index'])->name('home');

// Membuat resource route untuk TaskList
Route::resource('lists', TaskListController::class);

// Membuat resource route untuk Task
Route::resource('tasks', TaskController::class);

// Route untuk menandai tugas sebagai selesai
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

// Route untuk memindahkan tugas ke daftar lain
Route::patch('/tasks/{task}/change-list', [TaskController::class, 'changeList'])->name('tasks.changeList');
