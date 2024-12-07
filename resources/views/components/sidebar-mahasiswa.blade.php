@php
    use Illuminate\Support\Facades\Route;
@endphp
<div class="sidebar-container">
    <div class="sidebar p-3 text-white">
        <div class="text-center mb-4">
            <div class="profile-img rounded-circle mx-auto mb-3">
                <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
            </div>
            <h2 class="fs-4 fw-bold">{{ $mahasiswa->nama_mhs }}</h2>
            <p class="small opacity-75">NIM: {{ $mahasiswa->nim }}</p>
            <p class="small opacity-75">Mahasiswa<br>Program Studi S1 {{ $mahasiswa->prodi_nama }}<br> Fakultas Sains dan Matematika</p>
            <p class="small opacity-75">Dosen Wali: {{ $mahasiswa->nama_doswal }}<br>NIP. {{ $mahasiswa->nip }}</p>
        </div>
    
        <nav class="nav flex-column gap-2 mb-4">
            <a href="/dashboardMahasiswa" class="nav-link {{ Route::is('dashboardMahasiswa') ? 'active' : '' }} rounded d-flex align-items-center">
                <span class="material-icons me-3">home</span>
                Beranda
            </a>
            <a href="{{ route('mhs_rrencanaStudi') }}" class="nav-link {{ Route::is('mhs_rrencanaStudi') ? 'active' : '' }} rounded d-flex align-items-center">
                <span class="material-icons me-3">description</span>
                Rencana Studi
            </a>
            @if ($masaIRS == 'isiIRS')
                <a href="{{ route('mhs_newIRS') }}" class="nav-link {{ Route::is('mhs_newIRS') ? 'active' : '' }} rounded d-flex align-items-center">
                    <span class="material-icons me-3">create</span> <!-- "create" untuk ikon edit -->
                    Buat Rencana Studi
                </a>
            @elseif ($masaIRS == 'gantiIRS' || $masaIRS == 'batalIRS')
                <a href="{{ route('mhs_draftIRS') }}" class="nav-link {{ Route::is('mhs_draftIRS') ? 'active' : '' }} rounded d-flex align-items-center">
                    <span class="material-icons me-3">edit</span>
                    Edit Rencana Studi
                </a>
            @else
                <a href="{{ route('mhs_habisPeriodeIRS') }}" class="nav-link {{ Route::is('mhs_newIRS') ? 'active' : '' }} rounded d-flex align-items-center">
                    <span class="material-icons me-3">access_time</span> <!-- "access_time" untuk ikon periode habis -->
                    Buat Rencana Studi
                </a>
            @endif
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
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script to handle logout confirmation -->
    <script>
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
                    window.location.href = '/login';  // Redirect to the login page
                }
            });
        }
    </script>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script to handle logout confirmation -->
<script>
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
                window.location.href = '/login';  // Redirect to the login page
            }
        });
    }
</script>