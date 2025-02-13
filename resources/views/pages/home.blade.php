@extends('layouts.app')

@section('content')
    {{-- Kontainer utama dengan pengaturan overflow untuk menghindari scroll yang tidak diinginkan --}}
    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        {{-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol untuk menambahkan daftar baru --}}
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="text-center fst-italic">Belum ada tugas yang ditambahkan</p>
                {{-- Tombol untuk memicu modal penambahan daftar baru --}}
                <button type="button" class="btn d-flex align-items-center gap-2" style="width: fit-content;"
                    data-bs-toggle="modal" data-bs-target="#addListModal">
                    <i class="bi bi-plus-square fs-1"></i>
                </button>
            </div>
        @endif

        {{-- Form pencarian tugas atau daftar --}}
        <div class="row my-3">
            <div class="col-6 mx-auto">
                <form action="{{ route('home') }}" method="GET" class="d-flex gap-2">
                    {{-- Input untuk kata kunci pencarian --}}
                    <input type="text" class="form-control" name="query" placeholder="Cari tugas atau list..."
                        value="{{ request()->query('query') }}">
                    {{-- Tombol submit untuk pencarian --}}
                    <button type="submit" class="btn btn-outline-success">Cari</button>
                </form>
            </div>
        </div>

        {{-- Daftar semua list yang ada, ditampilkan secara horizontal dengan scroll --}}
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            @foreach ($lists as $list)
                {{-- Kartu untuk setiap list --}}
                <div class="card flex-shrink-0 bg-success-subtle" style="width: 18rem; max-height: 80vh;">
                    {{-- Header kartu dengan nama list dan tombol hapus --}}
                    <div class="card-header d-flex align-items-center justify-content-between bg-success">
                        <h4 class="card-title">{{ $list->name }}</h4>
                        {{-- Form untuk menghapus list --}}
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            {{-- Tombol hapus list --}}
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i>
                            </button>
                        </form>
                    </div>
                    {{-- Body kartu yang menampilkan tugas-tugas dalam list --}}
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($list->tasks as $task)
                            {{-- Kartu untuk setiap tugas --}}
                            <div class="card {{ $task->is_completed ? 'bg-secondary-subtle' : '' }}">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Indikator prioritas tinggi jika tugas belum selesai --}}
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            @endif
                                            {{-- Link ke detail tugas dengan penyesuaian tampilan jika tugas selesai --}}
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                {{ $task->name }}
                                            </a>
                                        </div>
                                        {{-- Form untuk menghapus tugas --}}
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            {{-- Tombol hapus tugas --}}
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- Deskripsi tugas dengan penyesuaian tampilan jika tugas selesai --}}
                                    <p
                                        class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                        {{ $task->description }}
                                    </p>
                                </div>
                                {{-- Tombol untuk menandai tugas sebagai selesai jika belum selesai --}}
                                @if (!$task->is_completed)
                                    <div class="card-footer">
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success w-100">
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
                        {{-- Tombol untuk menambahkan tugas baru ke dalam list --}}
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>

                    {{-- Footer kartu yang menampilkan jumlah tugas dalam list --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach

            {{-- Tombol untuk menambahkan list baru jika sudah ada list yang ada --}}
            @if ($lists->count() !== 0)
                <button type="button" class="btn btn-outline-success flex-shrink-0"
                    style="width: 18rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah
                    </span>
                </button>
            @endif
        </div>
    </div>
@endsection
