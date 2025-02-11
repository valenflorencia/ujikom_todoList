    @extends('layouts.app')

@section('content')
    <div id="content" class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 p-4 bg-white">
                <h1 class="mb-4 text-center text-primary fw-bold">📌 Detail Tugas</h1>

                <div class="row">
                    <div class="col-md-8">
                        <h3 class="mb-3 fw-semibold text-dark">{{ $task->name }}</h3>
                        <p class="text-muted fst-italic">{{ $task->description }}</p>
                    </div>
                    <div class="col-md-4 d-flex flex-column align-items-end">
                        <span class="badge text-bg-{{ $task->priorityClass }} fs-6 py-2 px-3 rounded-pill">
                            🚀 {{ ucfirst($task->priority) }}
                        </span>
                        <span class="badge text-bg-{{ $task->is_completed ? 'success' : 'danger' }} fs-6 py-2 px-3 rounded-pill mt-2">
                            {{ $task->is_completed ? '✅ Selesai' : '❌ Belum Selesai' }}
                        </span>
                    </div>
                </div>
                
                <div class="text-end mt-3 pb-3">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">&#8592; Kembali</a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal">✏️ Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tugas -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Tugas</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $task->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="priority" class="form-label">Prioritas</label>
                            <select class="form-select" id="priority" name="priority" required>
                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>low</option>
                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>medium</option>
                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>hight</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="is_completed" class="form-label">Status</label>
                            <select class="form-select" id="is_completed" name="is_completed" required>
                                <option value="0" {{ old('is_completed', $task->is_completed) == 0 ? 'selected' : '' }}>❌ Belum Selesai</option>
                                <option value="1" {{ old('is_completed', $task->is_completed) == 1 ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
