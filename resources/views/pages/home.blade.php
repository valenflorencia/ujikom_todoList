@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-hidden p-4 bg-light min-vh-100 mt-5">
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
                <p class="fw-bold text-center fs-5 text-secondary">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-lg d-flex align-items-center gap-2 btn-primary shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#addListModal">
                    <i class="bi bi-plus-square fs-3"></i> Tambah Tugas
                </button>
            </div>
        @endif
             {{-- ini untuk tombol button tambah todo list --}}
            <button type="button" class="btn btn-outline-primary flex-shrink-0 shadow-sm rounded-4" 
            style="width: 17rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
            <i class="bi bi-plus fs-5"></i> Tambah
        </button>

        <div class="d-flex gap-4 px-3 flex-nowrap overflow-x-scroll pb-4">
            @foreach ($lists as $list)
                <div class="card flex-shrink-0 shadow-lg border-0 rounded-4" style="width: 19rem; max-height: 80vh;">
                    <div class="card-header bg-info text-white d-flex align-items-center justify-content-between rounded-top-4">
                        <h5 class="card-title m-0">{{ $list->name }}</h5>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white p-0">
                                <i class="bi bi-trash fs-5"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column gap-3 overflow-y-auto">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                        <div>
                                            {{-- untuk  --}}
                                            <a href="{{ route('tasks.show', $task->id)}}" class="fw-bold m-0 {{ $task->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                                                {{ $task->name }}
                                            </a>
                                            <span class="badge text-bg-{{ $task->priorityClass }}">
                                                {{ $task->priority }}
                                            </span>
                                        </div>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-truncate">{{ $task->description }}</p>
                                    </div>
                                    @if (!$task->is_completed)
                                        <div class="card-footer bg-white">
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm bg-primary text-white w-100 rounded-pill">
                                                    <i class="bi bi-check"></i> Selesai
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                                    {{-- untuk menambah list --}}
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" 
                            data-bs-toggle="modal" data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <i class="bi bi-plus"></i> Tambah Tugas
                        </button>
                    </div>
                    <div class="card-footer bg-light rounded-bottom-4 text-center">
                        <small class="text-muted">{{ $list->tasks->count() }} Tugas</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
