<!-- Navbar dengan kelas Bootstrap untuk tampilan responsif dan efek bayangan -->
<nav class="navbar navbar-expand-lg fixed-top shadow-lg"
    style="
    background: rgba(40, 167, 69, 0.9);
    backdrop-filter: blur(15px);
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); 
    transition: all 0.3s ease-in-out;">
    <!-- Transisi halus untuk perubahan gaya -->
    {{-- Penjelasan script 
            background: rgba(40, 167, 69, 0.9); /* Warna latar belakang dengan transparansi */
            backdrop-filter: blur(15px); /* Efek blur di belakang navbar */
            border-bottom: 2px solid rgba(255, 255, 255, 0.1); /* Garis batas bawah navbar */
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); /* Bayangan di bawah navbar */ --}}

    <div class="container d-flex justify-content-between"> <!-- Kontainer untuk elemen navbar -->
        <!-- Nama Aplikasi -->
        <a class="navbar-brand fw-bolder text-white fs-4" href="#"> <i class="bi bi-houses"></i> AppTugas</a>

        <!-- Profil Pengguna dan Sosial Media -->
        <div class="d-flex align-items-center"> <!-- Flexbox untuk menyusun elemen secara horizontal -->
            <!-- Ikon Sosial Media -->
            <a href="https://github.com/valenflorencia" target="_blank" class="text-white me-3 fs-4">
                <i class="bi bi-github"></i> <!-- Ikon GitHub -->
            </a>
            <a href="https://www.instagram.com/s/aGlnaGxpZ2h0OjE4Mzc0NTY2Mzg0MTEzNzEy?story_media_id=3550331440799415880_44081362055&igsh=MWkxZzkzMnJ5b2xjMg=="
                target="_blank" class="text-white me-3 fs-4">
                <i class="bi bi-instagram"></i> <!-- Ikon Instagram -->
            </a>

            <!-- Dropdown Profil -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: 0.3s ease;">
                    <div class="profile-avatar">
                        <img src="/img/fotome.jpg" alt="Profil" class="rounded-circle"> <!-- Gambar profil -->
                    </div>
                    <span class="fw-semibold ms-2">Valen Florencia S</span> <!-- Nama Pengguna -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow animated-dropdown" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                    <!-- Menu Profil -->
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                    <!-- Menu Pengaturan -->
                    <li>
                        <hr class="dropdown-divider">
                    </li> <!-- Pembatas menu -->
                    <li><a class="dropdown-item text-danger" href="#"><i
                                class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                    <!-- Pembatas menu -->
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tambahkan CSS untuk Animasi -->
<style>
    .profile-avatar img {
        width: 50px;
        /* Lebar gambar profil */
        height: 50px;
        /* Tinggi gambar profil */
        object-fit: cover;
        /* Memastikan gambar tidak terdistorsi */
        object-position: center;
        /* Memusatkan gambar dalam lingkaran */
        border: 3px solid rgba(255, 255, 255, 0.6);
        /* Garis batas gambar profil */
        border-radius: 50%;
        /* Membuat gambar menjadi lingkaran */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        /* Transisi untuk efek hover */
    }

    .profile-avatar img:hover {
        transform: scale(1.2);
        /* Memperbesar gambar saat hover */
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        /* Efek bayangan saat hover */
    }

    .animated-dropdown {
        animation: fadeSlide 0.4s ease-in-out;
        /* Animasi untuk dropdown */
        border-radius: 12px;
        /* Membuat sudut dropdown menjadi melengkung */
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            /* Memulai dengan transparansi 0 (tidak terlihat) */
            transform: translateY(-10px);
            /* Memindahkan dropdown ke atas sebesar 10px */
        }

        to {
            opacity: 1;
            /* Mengubah transparansi menjadi 1 (sepenuhnya terlihat) */
            transform: translateY(0);
            /* Mengembalikan posisi dropdown ke posisi semula (tidak ada pergeseran) */
        }
    }
</style>
