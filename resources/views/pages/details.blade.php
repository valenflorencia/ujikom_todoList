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

@extends('layouts.app')

@section('content')
    <div id="content" class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 p-4 bg-white">
                <h1 class="mb-4 text-center text-primary fw-bold">📌 Detail Tugas</h1>

                <div class="row">
                    <!-- Bagian Informasi Tugas -->
                    <div class="col-md-8">
                        <h3 class="mb-3 fw-semibold text-dark">{{ $task->name }}</h3>
                        <p class="text-muted fst-italic">{{ $task->description }}</p>
                    </div>

                    <!-- Bagian Badge Status -->
                    <div class="col-md-4 d-flex flex-column align-items-end">
                        <span class="badge text-bg-{{ $task->priorityClass }} fs-6 py-2 px-3 rounded-pill">
                            🚀 {{ ucfirst($task->priority) }}
                        </span>
                        <span class="badge text-bg-{{ $task->status ? 'success' : 'danger' }} fs-6 py-2 px-3 rounded-pill mt-2">
                            ✅ {{ $task->status ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
