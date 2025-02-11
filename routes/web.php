<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;

// Membuat route untuk halaman utama (home) yang memanggil metode 'index' pada TaskController
Route::get('/', [TaskController::class, 'index'])->name('home');

// Menggunakan resource controller untuk TaskListController
// Secara otomatis akan membuat route untuk CRUD (Create, Read, Update, Delete) task lists
Route::resource('lists', TaskListController::class);

// Menggunakan resource controller untuk TaskController
// Secara otomatis akan membuat route untuk CRUD (Create, Read, Update, Delete) tasks
Route::resource('tasks', TaskController::class);

// Route untuk menandai tugas sebagai selesai (complete)
// Menggunakan method PATCH karena hanya memperbarui sebagian data
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

// Route untuk memperbarui tugas dengan metode PUT
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
