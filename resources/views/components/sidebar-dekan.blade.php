<!-- resources/views/sidebar.blade.php -->
@php
    use Illuminate\Support\Facades\Auth;

    // Mendapatkan user yang terautentikasi
    $user = Auth::user();

    // Memastikan user ada sebelum mencoba mengakses roles
    $userRole = $user ? ($user->roles1 ?? '') : '';
    $userRole2 = $user ? ($user->roles2 ?? '') : '';
    $roleSelected = session('roleSelected');
@endphp

    @if ($userRole == 'dosen' && $userRole2 == 'dekan' && $roleSelected == 'dekan')
        <!-- SIDEBAR DEKAN -->
        @if (isset($dekan_side))
        <a href="{{ route('sidebar.dekan') }}" class="nav-link">Dekan</a>
        <div class="text-center mb-4">
                <div class="profile-img rounded-circle mx-auto mb-3">
                    <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
                    <!-- Profile image placeholder -->
                </div>
                <h2 class="fs-4 fw-bold">{{ $dekan_side->dosen_nama }}</h2>
                <p class="small opacity-75">NIP. {{ $dekan_side->nip }}</p>
                <p class="small opacity-75">Dekan<br>Fakultas Sains dan Matematika</p>
                <p class="small opacity-75">Program Studi S1 {{ $dekan_side->prodi_nama }}<br> Fakultas Sains dan Matematika</p>
            </div>

            <nav class="nav flex-column gap-2 mb-4">
                <a href="#" class="nav-link active rounded d-flex align-items-center">
                    <span class="material-icons me-3">home</span>
                    Beranda
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">description</span>
                    Persetujuan Ruang
                </a>
                <a href="{{ route('mhs_rencanaStudi') }}" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">assessment</span>
                    Persetujuan Jadwal Kuliah
                </a>
            </nav>
        @endif
    @endif

    <!-- Logout Button -->
    <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">Keluar</button>

    <!-- Wave decoration -->
    <div class="wave-decoration">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
            <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg>
    </div>
</div>
