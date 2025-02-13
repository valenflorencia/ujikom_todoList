<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Metode untuk menampilkan halaman utama dengan daftar tugas dan list
    public function index(Request $request)
    {
        // Mengambil input pencarian dari permintaan
        $query = $request->input('query');

        // Jika ada input pencarian
        if ($query) {
            // Mencari tugas yang nama atau deskripsinya sesuai dengan query
            $tasks = Task::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest()
                ->get();

            // Mencari list yang namanya sesuai dengan query atau memiliki tugas yang sesuai dengan query
            $lists = TaskList::where('name', 'like', "%{$query}%")
                ->orWhereHas('tasks', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->with('tasks')
                ->get();

            // Jika tidak ada tugas yang ditemukan, memuat semua tugas dalam list
            if ($tasks->isEmpty()) {
                $lists->load('tasks');
            } else {
                // Jika ada tugas yang ditemukan, memuat hanya tugas yang sesuai dengan query dalam list
                $lists->load(['tasks' => function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                }]);
            }
        } else {
            // Jika tidak ada input pencarian, mengambil semua tugas dan list dengan tugasnya
            $tasks = Task::latest()->get();
            $lists = TaskList::with('tasks')->get();
        }

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Home',
            'lists' => $lists,
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES
        ];

        // Mengembalikan view 'pages.home' dengan data yang disiapkan
        return view('pages.home', $data);
    }

    // Metode untuk menyimpan tugas baru
    public function store(Request $request)
    {
        // Validasi input dari permintaan
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:255',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);

        // Membuat tugas baru dengan data yang valid
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

        // Mengarahkan kembali ke halaman sebelumnya
        return redirect()->back();
    }

    // Metode untuk menandai tugas sebagai selesai
    public function complete($id)
    {
        // Mencari tugas berdasarkan ID dan menandainya sebagai selesai
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        // Mengarahkan kembali ke halaman sebelumnya
        return redirect()->back();
    }

    // Metode untuk menghapus tugas
    public function destroy($id)
    {
        // Mencari tugas berdasarkan ID dan menghapusnya
        Task::findOrFail($id)->delete();

        // Mengarahkan kembali ke halaman utama
        return redirect()->route('home');
    }

    // Metode untuk menampilkan detail tugas
    public function show($id)
    {
        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Task',
            'lists' => TaskList::all(),
            'task' => Task::findOrFail($id),
        ];

        // Mengembalikan view 'pages.details' dengan data yang disiapkan
        return view('pages.details', $data);
    }

    // Metode untuk memindahkan tugas ke list lain
    public function changeList(Request $request, Task $task)
    {
        // Validasi input dari permintaan
        $request->validate([
            'list_id' => 'required|exists:task_lists,id',
        ]);

        // Memperbarui list_id tugas
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'List berhasil diperbarui!');
    }

    // Metode untuk memperbarui tugas
    public function update(Request $request, Task $task)
    {
        // Validasi input dari permintaan
        $request->validate([
            'list_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'priority' => 'required|in:low,medium,high'
        ]);

        // Memperbarui tugas dengan data yang valid
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
    }
}
