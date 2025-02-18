@extends('layouts.app')
<!-- Menggunakan template induk 'layouts.app' untuk konsistensi tata letak di seluruh aplikasi -->

@section('content')
    <div id="content" class="container mt-4"> <!-- Wadah utama untuk konten halaman dengan margin atas -->
        <!-- Tombol Kembali -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('home') }}" class="btn btn-outline-primary d-flex align-items-center shadow-sm">
                <i class="bi bi-arrow-left-circle fs-4"></i> <!-- Ikon panah kembali -->
                <span class="fw-bold fs-5 ms-2">Kembali</span> <!-- Teks tombol -->
            </a>
        </div>
        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <!-- Memeriksa apakah ada pesan sukses dalam sesi -->
            <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }} <!-- Menampilkan pesan sukses -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <!-- Tombol untuk menutup notifikasi -->
            </div>
        @endif

        <div class="row my-3">
            <!-- Kolom Task -->
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold text-truncate mb-0" style="max-width: 80%">
                            {{ $task->name }} <!-- Menampilkan nama tugas -->
                            <span class="fs-6 fw-light">di {{ $task->list->name }}</span> <!-- Menampilkan nama daftar tugas -->
                        </h3>
                        <button type="button" class="btn btn-sm btn-light shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#editTaskModal"> <!-- Tombol untuk membuka modal edit -->
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">{{ $task->description }}</p> <!-- Menampilkan deskripsi tugas -->
                    </div>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        <div class="card-footer bg-light">
                            @method('DELETE') <!-- Menggunakan metode DELETE untuk menghapus tugas -->
                            <button type="submit" class="btn btn-danger w-100 shadow-sm">Hapus</button> <!-- Tombol untuk menghapus tugas -->
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Detail -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="fw-bold mb-0">Detail</h4> <!-- Judul bagian detail -->
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.changeList', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH') <!-- Menggunakan metode PATCH untuk memindahkan tugas -->
                        <label for="list_id" class="form-label fw-semibold">Pindahkan ke:</label>
                        <select class="form-select shadow-sm" name="list_id" onchange="this.form.submit()">
                            @foreach ($lists as $list)
                                <option value="{{ $list->id }}" {{ $list->id == $task->list_id ? 'selected' : '' }}>
                                    {{ $list->name }} <!-- Menampilkan nama daftar tugas dalam dropdown -->
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <div class="mt-3">
                        <h6 class="fw-bold">Prioritas:</h6>
                        <span class="badge bg-{{ $task->priorityClass }} badge-pill px-3 py-2">
                            <i class="bi bi-exclamation-circle"></i> {{ ucfirst($task->priority) }} <!-- Menampilkan prioritas tugas dengan badge berwarna -->
                        </span>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">Status</h6>
                        <span class="px-3 py-2">
                            @if ($task->is_completed == 0)
                                <i class="bi bi-x-circle text-danger"></i> Belum Selesai <!-- Menampilkan status jika tugas belum selesai -->
                            @else
                                <i class="bi bi-check-circle text-success"></i> Selesai <!-- Menampilkan status jika tugas sudah selesai -->
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Task -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content shadow-lg">
                @method('PUT') <!-- Menggunakan metode PUT untuk memperbarui tugas -->
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="editTaskModalLabel">Edit Task</h5> <!-- Judul modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Tombol untuk menutup modal -->
                </div>
                <div class="modal-body">
                    <input type="hidden" name="list_id" value="{{ $task->list_id }}"> <!-- Menyimpan ID daftar tugas yang terkait -->

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Task</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name"
                            value="{{ $task->name }}" required> <!-- Input untuk nama tugas -->
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control shadow-sm" name="description" id="description" rows="3" required>{{ $task->description }}</textarea> <!-- Input untuk deskripsi tugas -->
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label fw-semibold">Prioritas</label>
                        <select class="form-control shadow-sm" name="priority" id="priority">
                            <option value="low" @selected($task->priority == 'low')>Low</option> <!-- Opsi untuk prioritas rendah -->
                            <option value="medium" @selected($task->priority == 'medium')>Medium</option> <!-- Opsi untuk prioritas sedang -->
                            <option value="high" @selected($task->priority == 'high')>High</option> <!-- Opsi untuk prioritas tinggi -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> <!-- Tombol untuk membatalkan perubahan -->
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button> <!-- Tombol untuk menyimpan perubahan -->
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Komentar ditambahkan di atas setiap bagian penting dari kode untuk menjelaskan fungsinya, seperti penggunaan template, tombol kembali, notifikasi, dan detail tugas.
Komentar juga menjelaskan setiap elemen dalam modal edit, termasuk input untuk nama, deskripsi, dan prioritas tugas. --}}