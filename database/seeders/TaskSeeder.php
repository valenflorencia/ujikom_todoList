<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Menjalankan seeder untuk mengisi tabel tasks dengan data awal.
     */
    public function run(): void
    {
        // Data tugas yang akan dimasukkan ke dalam tabel tasks
        $tasks = [
            [
                'name' => 'Belajar Laravel', // Nama tugas
                'description' => 'Belajar Laravel di santri koding', // Deskripsi tugas
                'is_completed' => false, // Status tugas (belum selesai)
                'priority' => 'medium', // Prioritas tugas
                'list_id' => TaskList::where('name', 'Belajar')->first()->id, // Mengambil ID list berdasarkan nama
            ],
            [
                'name' => 'Belajar React',
                'description' => 'Belajar React di WPU',
                'is_completed' => true, // Status tugas (sudah selesai)
                'priority' => 'high',
                'list_id' => TaskList::where('name', 'Belajar')->first()->id,
            ],
            [
                'name' => 'Pantai',
                'description' => 'Liburan ke Pantai bersama keluarga',
                'is_completed' => false,
                'priority' => 'low',
                'list_id' => TaskList::where('name', 'Liburan')->first()->id,
            ],
            [
                'name' => 'Villa',
                'description' => 'Liburan ke Villa bersama teman sekolah',
                'is_completed' => true,
                'priority' => 'medium',
                'list_id' => TaskList::where('name', 'Liburan')->first()->id,
            ],
            [
                'name' => 'Matematika',
                'description' => 'Tugas Matematika bu Nina',
                'is_completed' => true,
                'priority' => 'medium',
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                'name' => 'PAIBP',
                'description' => 'Tugas presentasi pa budi',
                'is_completed' => false,
                'priority' => 'high',
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                'name' => 'Project Ujikom',
                'description' => 'Membuat project Todo App untuk ujikom',
                'is_completed' => false,
                'priority' => 'high',
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                'name' => 'Gn. Rinjani',
                'description' => 'foto brg artis rinjani',
                'is_completed' => false,
                'priority' => 'high',
                'list_id' => TaskList::where('name', 'MDPL')->first()->id,
            ],
            [
                'name' => 'Mt. Ciremai',
                'description' => 'usahakan berdiri diatap jabar',
                'is_completed' => false,
                'priority' => 'medium',
                'list_id' => TaskList::where('name', 'MDPL')->first()->id,
            ],
            [
                'name' => 'Gn. Papandayan',
                'description' => 'foto bersama bunga abadi',
                'is_completed' => false,
                'priority' => 'medium',
                'list_id' => TaskList::where('name', 'MDPL')->first()->id,
            ],
        ];

        // Memasukkan data ke dalam tabel tasks
        Task::insert($tasks); // Menggunakan metode insert untuk menambahkan semua tugas sekaligus
    }
}