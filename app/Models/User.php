<?php

namespace App\Models;

// Mengimpor kelas yang diperlukan untuk model User
use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk factory
use Illuminate\Foundation\Auth\User as Authenticatable; // Mengimpor kelas Authenticatable untuk autentikasi
use Illuminate\Notifications\Notifiable; // Mengimpor trait Notifiable untuk notifikasi

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable; // Menggunakan trait HasFactory dan Notifiable

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', // Nama pengguna
        'email', // Alamat email pengguna
        'password', // Kata sandi pengguna
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password', // Kata sandi tidak akan ditampilkan saat serialisasi
        'remember_token', // Token untuk mengingat pengguna
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Mengonversi email_verified_at menjadi objek datetime
            'password' => 'hashed', // Mengonversi password menjadi hashed saat disimpan
        ];
    }
}