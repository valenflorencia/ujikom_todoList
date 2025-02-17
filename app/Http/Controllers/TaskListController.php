<?php

namespace App\Http\Controllers;

use App\Models\TaskList; // Mengimpor model TaskList
use Illuminate\Http\Request; // Mengimpor kelas Request dari Laravel

class TaskListController extends Controller
{
    // Metode untuk menyimpan daftar tugas baru
    public function store(Request $request) {
        // Validasi input dari permintaan
        $request->validate([
            'name' => 'required|max:100', // Nama daftar tugas harus diisi dan maksimal 100 karakter
        ]);

        // Membuat daftar tugas baru dengan data yang valid
        TaskList::create([
            'name' => $request->name, // Mengambil nama dari input
        ]);

        // Mengarahkan kembali ke halaman sebelumnya
        return redirect()->back();
    }

    // Metode untuk menghapus daftar tugas berdasarkan ID
    public function destroy($id) {
        // Mencari daftar tugas berdasarkan ID dan menghapusnya
        TaskList::findOrFail($id)->delete();

        // Mengarahkan kembali ke halaman sebelumnya
        return redirect()->back();
    }
}