<!-- Modal untuk menambahkan List -->
<div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Form untuk menambahkan List baru -->
        <form action="{{ route('lists.store') }}" method="POST" class="modal-content">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <!-- Input untuk nama List -->
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama list">
                </div>
            </div>
            <div class="modal-footer">
                <!-- Tombol untuk membatalkan penambahan List -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tombol untuk mengirim form dan menambahkan List -->
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk menambahkan Task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Form untuk menambahkan Task baru -->
        <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Input tersembunyi untuk menyimpan ID List yang terkait dengan Task -->
                <input type="text" id="taskListId" name="list_id" hidden>
                <div class="mb-3">
                    <!-- Input untuk nama Task -->
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama task">
                </div>
                <div class="mb-3">
                    <!-- Textarea untuk deskripsi Task -->
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Masukkan deskripsi"></textarea>
                </div>
                <div class="mb-3">
                    <!-- Dropdown untuk memilih prioritas Task -->
                    <label for="priority" class="form-label">Prioritas</label>
                    <select class="form-control" name="priority" id="editTaskPriority">
                        <option value="low">Rendah</option>
                        <option value="medium">Sedang</option>
                        <option value="high">Tinggi</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Tombol untuk membatalkan penambahan Task -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tombol untuk mengirim form dan menambahkan Task -->
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>
