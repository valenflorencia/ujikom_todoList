<?php

use Illuminate\Foundation\Inspiring; // Mengimpor kelas Inspiring untuk mendapatkan kutipan inspirasional
use Illuminate\Support\Facades\Artisan; // Mengimpor facade Artisan untuk mendefinisikan perintah kustom

// Mendefinisikan perintah Artisan kustom dengan nama 'inspire'
Artisan::command('inspire', function () {
    // Menampilkan kutipan inspirasional di konsol
    $this->comment(Inspiring::quote()); // Mengambil kutipan inspirasional dan menampilkannya di konsol
})->purpose('Display an inspiring quote') // Menetapkan tujuan dari perintah ini
->hourly(); // Menjadwalkan perintah ini untuk dijalankan setiap jam

// Komentar juga menjelaskan proses mendefinisikan perintah Artisan kustom, termasuk bagaimana kutipan inspirasional diambil dan ditampilkan di konsol.
// Selain itu, komentar menjelaskan tujuan dari perintah dan penjadwalan untuk menjalankannya setiap jam.