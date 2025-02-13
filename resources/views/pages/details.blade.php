@extends('layouts.app')

@section('content')
    <div id="content" class="container pb-3">
        <div class="d-flex align-items-center justify-content center mb-3">
            <a href="{{ route('home') }}" class="btn btn-sm fw-bold fs-4">
                <i class="bi bi-arrow-left-short"></i>
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-8">
                <div class="card" style="height: 80vh; max-height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                        <h3 class="fw-bold fs-4 text-truncate" style="max-width: 80%;">
                            {{ $task->name }}
                            <span class="fw-medium fs-6">di {{ $task->list->name }}</span>
                        </h3>
                        <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $task->description }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="height: 80vh; max-height: 80vh;">
                    <div class="card-header">
                        <h3 class="fw-bold fs-4">Detail</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between gap-2">
                            <form action="{{ route('tasks.updateList', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select class="form-select" id="list-selector" name="list_id" onchange="this.form.submit()">
                                    @foreach ($lists as $list)
                                        <option value="{{ $list->id }}"
                                            {{ $list->id == $task->list_id ? 'selected' : '' }}>
                                            {{ $list->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <p>
                                Prioritas:
                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill"
                                    style="width: fit-content">
                                    {{ $task->priority }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            Dibuat pada:
                            <span class="text-muted fw-bold">{{ $task->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
