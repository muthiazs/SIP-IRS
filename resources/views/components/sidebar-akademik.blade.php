<div class="sidebar container">
    <div class="sidebar p-4 text-white">
        <div class="text-center mb-4">
            <div class="profile-img rounded-circle mx-auto mb-3">
                <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
            </div>
            <h2 class="fs-4 fw-bold">{{ $akademik->nama }}</h2>
            <p class="small opacity-75">NIP. {{ $akademik->nip }}</p>
            <p class="small opacity-75">Tenaga Kependidikan</p>
            <p class="small opacity-75">Periode</p>
        </div>
    
        <nav class="nav flex-column gap-2 mb-4">
            <a href="/dashboardAkademik" class="nav-link active rounded d-flex align-items-center">
                <span class="material-icons me-3">home</span>
                Beranda
            </a>
            <div class="nav-item">
                <a href="/bak_PembagianRuang" class="nav-link rounded d-flex align-items-center toggle-submenu">
                    <span class="material-icons me-3">description</span>
                    Pembagian Ruang
                </a>
                <ul class="submenu">
                    <li><a href="/bak_PembagianRuang" class="nav-link">Atur Ruang</a></li>
                    <li><a href="/bak_CekStatusRuang" class="nav-link">Cek Ruang</a></li>
                    <li><a href="/bak_UpdateDeleteRuang" class="nav-link">Edit Ruang</a></li>
                    <li><a href="/bak_CreateRuang" class="nav-link">Tambahkan Ruang</a></li>
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
