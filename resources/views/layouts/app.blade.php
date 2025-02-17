<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding untuk dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur viewport untuk responsif -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Mengatur kompatibilitas dengan Internet Explorer -->

    <title>{{ $title }} - {{ config('app.name') }}</title> <!-- Menampilkan judul halaman dengan nama aplikasi -->

    <!-- Import bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"> <!-- Mengimpor CSS Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}"> <!-- Mengimpor ikon Bootstrap -->
</head>

<body>
    @include('partials.navbar') <!-- Mengambil komponen navbar dari partials/navbar.blade.php -->

    @yield('content') <!-- Tempat untuk merender konten dari view yang menggunakan template ini -->

    @include('partials.modal') <!-- Mengambil komponen modal dari partials/modal.blade.php -->

    {{-- Memanggil JavaScript --}}
    <script src="{{ asset('js/script.js') }}"></script> <!-- Mengimpor file JavaScript kustom -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- Mengimpor JavaScript Bootstrap -->
</body>

</html>