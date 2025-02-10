@extends('layouts.app')

@section('content')
    <!-- Container utama untuk konten halaman -->
    <div id="content" class="overflow-hidden p-4 bg-light min-vh-100 mt-5">
        
        <!-- Menampilkan pesan jika belum ada tugas yang ditambahkan -->
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
                <p class="fw-bold text-center fs-5 text-secondary">Belum ada tugas yang ditambahkan</p>
                <!-- Tombol untuk menambah tugas jika belum ada -->
                <button type="button" class="btn btn-lg d-flex align-items-center gap-2 btn-primary shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#addListModal">
                    <i class="bi bi-plus-square fs-3"></i> Tambah Tugas
                </button>
            </div>
        @endif

        <!-- Tombol utama untuk menambah daftar tugas -->
        <button type="button" class="btn btn-outline-primary flex-shrink-0 shadow-sm rounded-4" 
            style="width: 17rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
            <i class="bi bi-plus fs-5"></i> Tambah
        </button>

        <!-- Container untuk daftar tugas, bisa di-scroll secara horizontal -->
        <div class="d-flex gap-4 px-3 flex-nowrap overflow-x-scroll pb-4">
            @foreach ($lists as $list)
                <!-- Kartu untuk setiap daftar tugas -->
                <div class="card flex-shrink-0 shadow-lg border-0 rounded-4" style="width: 19rem; max-height: 80vh;">
                    
                    <!-- Header kartu dengan nama daftar tugas dan tombol hapus -->
                    <div class="card-header bg-info text-white d-flex align-items-center justify-content-between rounded-top-4">
                        <h5 class="card-title m-0">{{ $list->name }}</h5>
                        <!-- Form untuk menghapus daftar tugas -->
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white p-0">
                                <i class="bi bi-trash fs-5"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Body kartu yang berisi daftar tugas dalam satu list -->
                    <div class="card-body d-flex flex-column gap-3 overflow-y-auto">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <!-- Kartu untuk setiap tugas -->
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- Link untuk membuka detail tugas -->
                                            <a href="{{ route('tasks.show', $task->id)}}" class="fw-bold m-0 {{ $task->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                                                {{ $task->name }}
                                            </a>
                                            <!-- Badge untuk menampilkan prioritas tugas -->
                                            <span class="badge text-bg-{{ $task->priorityClass }}">
                                                {{ $task->priority }}
                                            </span>
                                        </div>
                                        <!-- Form untuk menghapus tugas -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <!-- Deskripsi tugas (jika panjang, akan terpotong) -->
                                        <p class="card-text text-truncate">{{ $task->description }}</p>
                                    </div>

                                    <!-- Jika tugas belum selesai, tampilkan tombol "Selesai" -->
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

                        <!-- Tombol untuk menambah tugas dalam daftar -->
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" 
                            data-bs-toggle="modal" data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <i class="bi bi-plus"></i> Tambah Tugas
                        </button>
                    </div>

                    <!-- Footer kartu yang menampilkan jumlah tugas dalam daftar -->
                    <div class="card-footer bg-light rounded-bottom-4 text-center">
                        <small class="text-muted">{{ $list->tasks->count() }} Tugas</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
