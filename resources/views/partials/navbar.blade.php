<nav class="navbar navbar-expand-lg fixed-top shadow-lg"
    style="
    background: rgba(40, 167, 69, 0.9); /* Warna hijau dengan transparansi */
    backdrop-filter: blur(15px); /* Blur lebih halus */
    border-bottom: 2px solid rgba(255, 255, 255, 0.1); /* Border tipis untuk kesan modern */
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); /* Soft shadow */
    transition: all 0.3s ease-in-out;">

    <div class="container d-flex justify-content-between">
        <!-- Nama Aplikasi -->
        <a class="navbar-brand fw-bolder text-white fs-4" href="#"> 📑 AppTugas</a>

        <!-- Profil Pengguna -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: 0.3s ease;">

                <!-- Avatar dengan Efek Hover -->
                <div class="profile-avatar">
                    <img src="/img/fotome.jpg" alt="Profil" class="rounded-circle">
                </div>

                <span class="fw-semibold ms-2">Valen Florencia S</span>
            </a>

            <!-- Dropdown Menu dengan Animasi -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated-dropdown" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tambahkan CSS untuk Animasi -->
<style>
    /* Efek Avatar */
    .profile-avatar img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        object-position: center;
        border: 3px solid rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .profile-avatar img:hover {
        transform: scale(1.2);
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
    }

    /* Animasi Dropdown */
    .animated-dropdown {
        animation: fadeSlide 0.4s ease-in-out;
        border-radius: 12px;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
