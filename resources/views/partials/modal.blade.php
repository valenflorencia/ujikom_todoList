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
                    <select class="form-select form-select-sm" aria-label="Small select example" id="priority" name="priority">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let addTaskModal = document.getElementById("addTaskModal");
            
            addTaskModal.addEventListener("show.bs.modal", function(event) {
                let button = event.relatedTarget; // Tombol yang diklik
                let listId = button.getAttribute("data-list"); // Ambil ID List dari tombol
                
                // Set ID List di dalam modal
                document.getElementById("taskListId").value = listId;
            });
        });
    </script> 
