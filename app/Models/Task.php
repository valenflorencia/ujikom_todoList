<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // Mengimpor kelas Model dari Eloquent
use App\Models\TaskList; // Mengimpor model TaskList

class Task extends Model
{
    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'name', // Nama tugas
        'description', // Deskripsi tugas
        'is_completed', // Status penyelesaian tugas
        'priority', // Prioritas tugas
        'list_id' // ID daftar tugas yang terkait
    ];

    // Atribut yang dilindungi dari pengisian massal
    protected $guarded = [
        'id', // ID tugas (otomatis dihasilkan)
        'created_at', // Tanggal dan waktu pembuatan
        'updated_at' // Tanggal dan waktu pembaruan
    ];

    // Daftar prioritas yang tersedia untuk tugas
    const PRIORITIES = [
        'low', // Prioritas rendah
        'medium', // Prioritas sedang
        'high' // Prioritas tinggi
    ];

    // Aksesori untuk mendapatkan kelas CSS berdasarkan prioritas tugas
    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success', // Kelas CSS untuk prioritas rendah
            'medium' => 'warning', // Kelas CSS untuk prioritas sedang
            'high' => 'danger', // Kelas CSS untuk prioritas tinggi
            default => 'secondary' // Kelas CSS default jika tidak ada yang cocok
        };
    }

    // Relasi antara tugas dan daftar tugas
    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id'); // Menghubungkan tugas dengan daftar tugas berdasarkan list_id
    }
}