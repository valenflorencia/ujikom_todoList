<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Menampilkan daftar tugas dan list tugas.
     */
    public function index() {
        $data = [
            'title' => 'Home', // Judul halaman
            'lists' => TaskList::all(), // Mengambil semua daftar tugas
            'tasks' => Task::orderBy('created_at', 'desc')->get(), // Mengambil semua tugas, diurutkan dari yang terbaru
            'priorities' => Task::PRIORITIES // Mengambil daftar prioritas tugas
        ];

        return view('pages.home', $data); // Mengembalikan view halaman utama dengan data
    }

    /**
     * Memperbarui data tugas berdasarkan ID.
     */
    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'is_completed' => 'required|boolean'
        ]);
    
        // Mencari tugas berdasarkan ID, jika tidak ditemukan akan gagal
        $task = Task::findOrFail($id);

        // Memperbarui data tugas
        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'is_completed' => $request->is_completed
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }
    
    /**
     * Menyimpan tugas baru ke dalam database.
     */
    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required' // ID list harus ada
        ]);

        // Membuat tugas baru
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }

    /**
     * Menandai tugas sebagai selesai.
     */
    public function complete($id) {
        // Mencari tugas berdasarkan ID, jika tidak ditemukan akan gagal
        Task::findOrFail($id)->update([
            'is_completed' => true // Mengubah status tugas menjadi selesai
        ]);

        return redirect()->back();
    }

    /**
     * Menghapus tugas berdasarkan ID.
     */
    public function destroy($id) {
        // Mencari tugas dan menghapusnya jika ditemukan
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }

    /**
     * Menampilkan detail tugas berdasarkan ID.
     */
    public function show($id) {
        // Mencari tugas berdasarkan ID, jika tidak ditemukan akan gagal
        $task = Task::findOrFail($id);

        $data = [
            'title' => 'Details', // Judul halaman
            'task' => $task, // Data tugas yang akan ditampilkan
        ];

        return view('pages.details', $data); // Mengembalikan view dengan data tugas
    }
}
