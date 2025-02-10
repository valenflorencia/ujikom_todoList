{{-- untuk 
@extends('layouts.app') 

@section('content')
    <div id="content" class="row">
        <h1 class="mb-3">Halaman Details</h1>

        <div class="row">
            <div class="col-8">
                <h3 class="mb-2">{{ $task->name}}</h3>
                <p class="text-muted">{{ $task->description }}</p>

            </div>
            <div class="col-4">
                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill" style="width: fit-content">
                    {{ $task->priority}}
                </span>
                <span class="badge text-bg-{{ $task->status ? 'success' : 'danger'}} badge-pill" style="width: fit-content">
                    {{$task->status ? 'Selesai' : 'Belum Selesai'}}
                </span>
            </div>
        </div>
    </div>
@endsection  --}}

@extends('layouts.app') <!-- Menggunakan template layout utama -->

@section('content')
    <!-- Container utama yang berisi detail tugas -->
    <div id="content" class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 p-4 bg-white">
                <!-- Judul halaman -->
                <h1 class="mb-4 text-center text-primary fw-bold">📌 Detail Tugas</h1>

                <div class="row">
                    <!-- Bagian Informasi Tugas -->
                    <div class="col-md-8">
                        <!-- Menampilkan Nama Tugas -->
                        <h3 class="mb-3 fw-semibold text-dark">{{ $task->name }}</h3>
                        <!-- Menampilkan Deskripsi Tugas -->
                        <p class="text-muted fst-italic">{{ $task->description }}</p>
                    </div>

                    <!-- Bagian Badge Status -->
                    <div class="col-md-4 d-flex flex-column align-items-end">
                        <!-- Badge untuk menampilkan prioritas tugas -->
                        <span class="badge text-bg-{{ $task->priorityClass }} fs-6 py-2 px-3 rounded-pill">
                            🚀 {{ ucfirst($task->priority) }}
                        </span>
                        <!-- Badge untuk menampilkan status tugas (selesai/belum selesai) -->
                        <span class="badge text-bg-{{ $task->is_completed ? 'success' : 'danger' }} fs-6 py-2 px-3 rounded-pill mt-2">
                            {{ $task->is_completed ? '✅ Selesai' : '❌ Belum Selesai' }}
                        </span>
                    </div>
                </div>
                
                <!-- Tombol Kembali ke halaman daftar tugas -->
                <div class="text-end mt-1 pb-3">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">&#8592; Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
