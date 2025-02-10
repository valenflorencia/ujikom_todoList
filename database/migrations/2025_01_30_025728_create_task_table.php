<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance dari class anonymous yang mewarisi Migration
return new class extends Migration
{
    /**
     * Menjalankan migration.
     * Fungsi ini akan membuat tabel 'tasks' di database.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            // Membuat kolom 'id' sebagai primary key dengan tipe big integer (auto increment)
            $table->id();

            // Kolom untuk menyimpan nama tugas
            $table->string('name');

            // Kolom untuk menyimpan deskripsi tugas (bisa null)
            $table->string('description')->nullable();

            // Kolom boolean untuk menandai apakah tugas sudah selesai atau belum, default-nya false
            $table->boolean('is_completed')->default(false);

            // Kolom enum untuk menyimpan prioritas tugas dengan tiga nilai: low, medium, high (default: medium)
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // Menambahkan kolom 'created_at' dan 'updated_at' secara otomatis
            $table->timestamps();

            // Kolom 'list_id' sebagai foreign key yang terhubung ke tabel 'task_lists'
            // Jika daftar tugas dihapus, semua tugas di dalamnya juga akan terhapus (cascade delete)
            $table->foreignId('list_id')->constrained('task_lists', 'id')->onDelete('cascade');
        });
    }

    /**
     * Membatalkan migration.
     * Fungsi ini akan menghapus tabel 'tasks' jika sudah ada.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
