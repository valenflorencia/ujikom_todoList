<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance dari class anonymous yang mewarisi Migration
return new class extends Migration
{
    /**
     * Menjalankan migration.
     * Fungsi ini akan membuat tabel 'sessions' di database.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            // Membuat kolom 'id' sebagai primary key dengan tipe string
            $table->string('id')->primary();

            // Membuat kolom 'user_id' sebagai foreign key yang bisa bernilai null
            $table->foreignId('user_id')->nullable()->index();

            // Menyimpan alamat IP pengguna dengan maksimal 45 karakter (IPv4/IPv6)
            $table->string('ip_address', 45)->nullable();

            // Menyimpan informasi user agent (browser, OS, dll.)
            $table->text('user_agent')->nullable();

            // Menyimpan data sesi dalam bentuk longText
            $table->longText('payload');

            // Menyimpan timestamp dari aktivitas terakhir (untuk tracking sesi aktif)
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Membatalkan migration.
     * Fungsi ini akan menghapus tabel 'sessions' jika sudah ada.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
