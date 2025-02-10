<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance dari class anonymous yang mewarisi Migration
return new class extends Migration
{
    /**
     * Menjalankan migration.
     * Fungsi ini akan membuat tabel 'task_lists' di database.
     */
    public function up(): void
    {
        Schema::create('task_lists', function (Blueprint $table) {
            // Membuat kolom 'id' sebagai primary key dengan tipe big integer (auto increment)
            $table->id();

            // Membuat kolom 'name' sebagai string yang unik (tidak boleh ada nama list yang sama)
            $table->string('name')->unique();

            // Menambahkan kolom 'created_at' dan 'updated_at' secara otomatis
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     * Fungsi ini akan menghapus tabel 'task_lists' jika sudah ada.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_lists');
    }
};
