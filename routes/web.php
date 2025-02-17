<?php

use App\Http\Controllers\TaskController; // Mengimpor TaskController untuk mengelola tugas
use App\Http\Controllers\TaskListController; // Mengimpor TaskListController untuk mengelola daftar tugas
use Illuminate\Support\Facades\Route; // Mengimpor facade Route untuk mendefinisikan rute

// Membuat route untuk halaman utama
Route::get('/', [TaskController::class, 'index'])->name('home'); // Mengarahkan permintaan GET ke metode index di TaskController

// Membuat resource route untuk TaskList
Route::resource('lists', TaskListController::class); // Menghasilkan rute CRUD untuk TaskList secara otomatis

// Membuat resource route untuk Task
Route::resource('tasks', TaskController::class); // Menghasilkan rute CRUD untuk Task secara otomatis

// Route untuk menandai tugas sebagai selesai
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete'); // Mengarahkan permintaan PATCH untuk menandai tugas sebagai selesai

// Route untuk memindahkan tugas ke daftar lain
Route::patch('/tasks/{task}/change-list', [TaskController::class, 'changeList'])->name('tasks.changeList'); // Mengarahkan permintaan PATCH untuk memindahkan tugas ke daftar lain