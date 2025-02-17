<nav class="navbar navbar-expand-lg fixed-top shadow-lg"
    style="
    background: rgba(40, 167, 69, 0.9); /* Warna hijau dengan transparansi */
    backdrop-filter: blur(15px); /* Blur lebih halus di belakang navbar */
    border-bottom: 2px solid rgba(255, 255, 255, 0.1); /* Border tipis untuk kesan modern */
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); /* Soft shadow untuk efek kedalaman */
    transition: all 0.3s ease-in-out;"> <!-- Transisi halus untuk perubahan gaya -->

    <div class="container d-flex justify-content-between">
        <!-- Nama Aplikasi -->
        <a class="navbar-brand fw-bolder text-white fs-4" href="#"> 📑 AppTugas</a>

        <!-- Profil Pengguna -->
        <div class="dropdown">
            <!-- Tautan untuk membuka dropdown profil -->
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: 0.3s ease;">

                <!-- Avatar dengan Efek Hover -->
                <div class="profile-avatar">
                    <img src="/img/fotome.jpg" alt="Profil" class="rounded-circle"> <!-- Gambar profil pengguna -->
                </div>

                <span class="fw-semibold ms-2">Valen Florencia S</span> <!-- Nama pengguna -->
            </a>

            <!-- Dropdown Menu dengan Animasi -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated-dropdown" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profil</a></li> <!-- Tautan ke profil -->
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li> <!-- Tautan ke pengaturan -->
                <li><hr class="dropdown-divider"></li> <!-- Pembatas antara item dropdown -->
                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li> <!-- Tautan untuk keluar -->
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Mengimpor ikon Bootstrap -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap -->

<!-- Tambahkan CSS untuk Animasi -->
<style>
    /* Efek Avatar */
    .profile-avatar img {
        width: 50px; /* Lebar gambar avatar */
        height: 50px; /* Tinggi gambar avatar */
        object-fit: cover; /* Memastikan gambar mengisi area tanpa distorsi */
        object-position: center; /* Memusatkan gambar dalam lingkaran */
        border: 3px solid rgba(255, 255, 255, 0.6); /* Border putih transparan di sekitar avatar */
        border-radius: 50%; /* Membuat gambar menjadi lingkaran */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Transisi halus untuk efek hover */
    }

    .profile-avatar img:hover {
        transform: scale(1.2); /* Memperbesar gambar saat hover */
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8); /* Menambahkan efek bayangan saat hover */
    }

    /* Animasi Dropdown */
    .animated-dropdown {
        animation: fadeSlide 0.4s ease-in-out; /* Menambahkan animasi saat dropdown muncul */
        border-radius: 12px; /* Membuat sudut dropdown menjadi melengkung */
    }

    @keyframes fadeSlide {
        from {
            opacity: 0; /* Memulai dengan transparansi 0 */
            transform: translateY(-10px); /* Memulai dari posisi sedikit di atas */
        }
        to {
            opacity: 1; /* Menjadi sepenuhnya terlihat */
            transform: translateY(0); /* Kembali ke posisi normal */
        }
    }
</style>