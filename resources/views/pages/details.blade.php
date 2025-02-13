@extends('layouts.app')

@section('content')
<div id="content" class="container">
    <!-- Tombol Kembali -->
    <div class="d-flex align-items-center">
        <a href="{{ route('home') }}" class="btn btn-light shadow-sm d-flex align-items-center">
            <i class="bi bi-arrow-left-short fs-4"></i>
            <span class="fw-bold fs-5 ms-1">Kembali</span>
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row my-3">
        <!-- Kolom Task -->
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="fw-bold text-truncate mb-0" style="max-width: 80%">
                        {{ $task->name }}
                        <span class="fs-6 fw-light">di {{ $task->list->name }}</span>
                    </h3>
                    <button type="button" class="btn btn-sm btn-light shadow-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ $task->description }}</p>
                </div>
                <div class="card-footer bg-light">
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 shadow-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Detail -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="fw-bold mb-0">Detail</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.changeList', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="list_id" class="form-label fw-semibold">Pindahkan ke:</label>
                        <select class="form-select shadow-sm" name="list_id" onchange="this.form.submit()">
                            @foreach ($lists as $list)
                                <option value="{{ $list->id }}" {{ $list->id == $task->list_id ? 'selected' : '' }}>
                                    {{ $list->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <div class="mt-3">
                        <h6 class="fw-bold">Prioritas:</h6>
                        <span class="badge text-bg-{{ $task->priorityClass }} badge-pill px-3 py-2">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">Status</h6>
                        <span class="px-3 py-2">
                            @if($task->is_completed == 0)
                            Belum Selesai
                            @else
                            Selesai
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Task -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content shadow-lg">
            @method('PUT')
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="list_id" value="{{ $task->list_id }}">

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Task</label>
                    <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ $task->name }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control shadow-sm" name="description" id="description" rows="3" required>{{ $task->description }}</textarea>
                </div>

                <!-- Prioritas -->
                <div class="mb-3">
                    <label for="priority" class="form-label fw-semibold">Prioritas</label>
                    <select class="form-control shadow-sm" name="priority" id="priority">
                        <option value="low" @selected($task->priority == 'low')>Low</option>
                        <option value="medium" @selected($task->priority == 'medium')>Medium</option>
                        <option value="high" @selected($task->priority == 'high')>High</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection