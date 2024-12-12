@php
    use Illuminate\Support\Facades\Route;
@endphp
<div class="sidebar-container">
    <div class="sidebar p-4 text-white">
        <div class="text-center mb-4">
            <div class="profile-img rounded-circle mx-auto mb-3">
                <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
            </div>
            <h2 class="fs-4 fw-bold">{{ $kaprodi->dosen_nama }}</h2>
            <p class="small opacity-75">NIP. {{ $kaprodi->nip }}</p>
            <p class="small opacity-75">Ketua Program Studi<br>Program Studi S1 {{ $kaprodi->prodi_nama }}<br> Fakultas Sains dan Matematika</p>
        </div>
    
        <nav class="nav flex-column gap-2 mb-4">
            <a href="/dashboardKaprodi" class="nav-link {{ Route::is('dashboardKaprodi') ? 'active' : '' }} rounded d-flex align-items-center">
                <span class="material-icons me-3">home</span>
                Beranda
            </a>
            <div class="nav-item">
                <a href="/kaprodi_JadwalKuliah" 
                class="nav-link {{ Route::is('kaprodi_JadwalKuliah') || Route::is('kaprodi_UpdateDeleteMatkul') || Route::is('kaprodi_CreateJadwal') ? 'active' : '' }} rounded d-flex align-items-center toggle-submenu">
                    <span class="material-icons me-3">description</span>
                    Jadwal Kuliah
                </a>

                <ul class="submenu">
                    <li><a href="/kaprodi_JadwalKuliah" class="nav-link {{ Route::is('kaprodi_JadwalKuliah') || Route::is('kaprodi_CreateJadwal') ? 'active' : '' }}">Set Jadwal Kuliah</a></li>
                    <li><a href="/kaprodi_UpdateDeleteMatkul" class="nav-link {{ Route::is('kaprodi_UpdateDeleteMatkul') ? 'active' : '' }}">Atur Mata Kuliah</a></li>
                </ul>
            </div>
        </nav>

        <!-- Logout Button -->
        <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3" onclick="confirmLogout()">Keluar</button>
    
        <!-- Wave decoration -->
        <div class="wave-decoration">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Styles -->
<style>
    /* Styling Submenu */
    .submenu {
        display: none; /* Submenu tersembunyi secara default */
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .submenu li {
        margin: 5px 0;
    }

    .submenu .nav-link {
        font-size: 14px; /* Ukuran lebih kecil */
        padding-left: 50px; /* Sejajar dengan menu utama */
        color: #dfe6e9;
        text-decoration: none;
    }

    .submenu .nav-link:hover {
        color: #ffffff;
    }

    .nav-item.active .submenu {
        display: block; /* Tampilkan submenu jika menu aktif */
    }

    /* Tambahkan styling tambahan jika diperlukan */
</style>

<!-- Scripts -->
<script>
    // Toggle submenu visibility on click
    document.querySelectorAll('.toggle-submenu').forEach((menu) => {
        menu.addEventListener('click', (e) => {
            e.preventDefault();
            const parent = menu.parentElement;
            parent.classList.toggle('active'); // Toggle "active" class
        });
    });

    // Script to handle logout confirmation
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login'; // Redirect to the login page
            }
        });
    }
</script>
