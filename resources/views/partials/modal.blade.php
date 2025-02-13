    <div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('lists.store') }}" method="POST" class="modal-content">
                @method('POST') <!-- Metode HTTP POST untuk menambahkan data -->
                @csrf <!-- Token CSRF untuk keamanan Laravel -->

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Input untuk Nama List -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan nama list">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-info">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
                @method('POST')
                @csrf

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- ID List (disembunyikan) -->
                    <input type="text" id="taskListId" name="list_id" hidden>

                    <!-- Input Nama Task -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan nama list">
                    </div>

                    <!-- Input Deskripsi Task -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Masukkan deskripsi">
                    </div>

                    <!-- Dropdown Prioritas Task -->
                    <select class="form-select form-select-sm" aria-label="Small select example" id="priority"
                        name="priority">
                        <option value="low">low</option>
                        <option value="medium" selected>medium</option>
                        <option value="high">high</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-info">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content">
                @method('PUT')
                @csrf

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- ID List (disembunyikan) -->
                    <input type="hidden" name="list_id" value="{{ $task->list_id }}">

                    <!-- Input Nama Task -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $task->name }}" placeholder="Masukkan nama task" required>
                    </div>

                    <!-- Input Deskripsi Task -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi"
                            required>{{ $task->description }}</textarea>
                    </div>

                    <!-- Dropdown Prioritas Task -->
                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioritas</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
