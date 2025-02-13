<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Mendefinisikan perintah Artisan kustom dengan nama 'inspire'
Artisan::command('inspire', function () {
    // Menampilkan kutipan inspirasional di konsol
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
