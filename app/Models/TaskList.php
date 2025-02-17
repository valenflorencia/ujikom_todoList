<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // Mengimpor kelas Model dari Eloquent

class TaskList extends Model
{
    // Atribut yang dapat diisi secara massal
    protected $fillable = ['name']; // Nama daftar tugas

    // Atribut yang dilindungi dari pengisian massal
    protected $guarded = [
        'id', // ID daftar tugas (otomatis dihasilkan)
        'created_at', // Tanggal dan waktu pembuatan
        'updated_at' // Tanggal dan waktu pembaruan
    ];

    // Relasi antara daftar tugas dan tugas
    public function tasks() {
        return $this->hasMany(Task::class, 'list_id'); // Menghubungkan daftar tugas dengan banyak tugas berdasarkan list_id
    }
}