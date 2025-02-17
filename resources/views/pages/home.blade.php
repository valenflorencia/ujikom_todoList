@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-y-hidden overflow-x-hidden bg-light position-relative"
        style="background: url('/images/butterfly-bg.jpg') no-repeat center center fixed; background-size: cover; min-height: 100vh;">
        <!-- Overlay untuk memberikan efek transparan di atas background -->
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(255, 255, 255, 0.6);">
        </div>

        <div class="container position-relative z-1">
            @if ($lists->count() == 0)
                <!-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol untuk menambah list -->
                <div class="d-flex flex-column align-items-center text-primary">
                    <p class="text-center fst-italic fs-4">Belum ada tugas yang ditambahkan</p>
                    <button type="button"
                        class="btn btn-outline-primary d-flex align-items-center gap-2 shadow-lg px-4 py-2 rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#addListModal">
                        <i class="bi bi-plus-square fs-1"></i> Tambah List
                    </button>
                </div>
            @endif

            <div class="row my-3">
                <div class="col-6 mx-auto">
                    <!-- Form pencarian untuk mencari tugas atau list -->
                    <form action="{{ route('home') }}" method="GET"
                        class="d-flex gap-3 shadow rounded-pill p-3 bg-white bg-opacity-75">
                        <input type="text" class="form-control border-0 shadow-sm rounded-pill px-3"
                            name="query" placeholder="🔍 Cari tugas atau list..." 
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4 py-2 fw-semibold">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
            
            @if ($lists->count() !== 0)
                <!-- Jika ada daftar tugas, tampilkan tombol untuk menambah list -->
                <div class="d-flex justify-content-center mt-4 py-4">
                    <button type="button" class="btn btn-outline-primary flex-shrink-0 rounded-pill shadow-lg px-5 py-3 fw-semibold"
                        style="width: 15rem; height: fit-content; transition: all 0.3s ease-in-out;"
                        data-bs-toggle="modal" data-bs-target="#addListModal">
                        <span class="d-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle fs-6"></i>
                            <span class="fs-5">Tambah List</span>
                        </span>
                    </button>
                </div>
            @endif            

            <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden pb-4" style="height: 100vh;">
                @foreach ($lists as $list)
                    <!-- Menampilkan setiap daftar tugas dalam bentuk kartu -->
                    <div class="card flex-shrink-0 border-0 shadow-lg rounded-4 overflow-hidden position-relative"
                        style="width: 18rem; max-height: 80vh; background: linear-gradient(135deg, #a8e6cf, #dcedc1); transition: transform 0.3s ease-in-out;">
                        <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                            <h4 class="card-title">{{ $list->name }}</h4>
                            <!-- Form untuk menghapus list -->
                            <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm p-0">
                                    <i class="bi bi-trash fs-5 text-danger"></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                            @foreach ($list->tasks as $task)
                                <!-- Menampilkan setiap tugas dalam daftar -->
                                <div
                                    class="card border-0 shadow-sm rounded-3 {{ $task->is_completed ? 'bg-secondary-subtle' : '' }}">
                                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                                <!-- Menampilkan indikator loading jika tugas memiliki prioritas tinggi dan belum selesai -->
                                                <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            @endif
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                {{ $task->name }} <!-- Nama tugas -->
                                            </a>
                                        </div>
                                        <!-- Form untuk menghapus tugas -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <p
                                            class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                            {{ $task->description }} <!-- Deskripsi tugas -->
                                        </p>
                                    </div>
                                    @if (!$task->is_completed)
                                        <div class="card-footer bg-light">
                                            <!-- Form untuk menandai tugas sebagai selesai -->
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success w-100 rounded-pill">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check fs-5"></i>
                                                        Selesai
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <!-- Tombol untuk menambah tugas baru ke dalam list -->
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill mt-2"
                                data-bs-toggle="modal" data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                                <span class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-plus fs-5"></i>
                                    Tambah
                                </span>
                            </button>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                            <p class="card-text">{{ $list->tasks->count() }} Tugas</p> <!-- Menampilkan jumlah tugas dalam list -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- Komentar menjelaskan struktur tampilan, termasuk bagaimana daftar tugas dan tugas ditampilkan, serta bagaimana pengguna dapat menambah, menghapus, dan menyelesaikan tugas. --}}