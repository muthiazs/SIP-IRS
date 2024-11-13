<<<<<<< HEAD
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


    @if ($userRole == 'mahasiswa')
        <!-- SIDEBAR MAHASISWA -->
        @if (@isset($mahasiswa))
            <a href="{{ route('sidebar.mahasiswa') }}" class="nav-link">Mahasiswa</a>
            <div class="text-center mb-4">
                <div class="profile-img mb-3">
                    <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
                </div>
                <h2 class="fs-4 fw-bold">{{ $Mahasiswa->nama_mhs }}</h2>
                <p class="small opacity-75">NIM: {{ $Mahasiswa->nim }}</p>
                <p class="small opacity-75">Mahasiswa<br>Program Studi S1 {{ $Mahasiswa->prodi_nama }}<br> Fakultas Sains dan Matematika</p>
                <p class="small opacity-75">Dosen Wali: {{ $Mahasiswa->nama_doswal }}<br>NIP. {{ $Mahasiswa->nip }}</p>
            </div>

            <nav class="nav flex-column gap-2 mb-4">
                <a href="#" class="nav-link active rounded d-flex align-items-center">
                    <span class="material-icons me-3">home</span>
                    Beranda
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">description</span>
                    Rencana Studi
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">assessment</span>
                    Hasil Studi
                </a>
            </nav>
            @endif


    @endif

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">Keluar</button>
    </form>

    <!-- Wave decoration -->
    <div class="wave-decoration">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
            <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg>
    </div>
</div>
=======
<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>
>>>>>>> 17c21c2baba16b05bc793df7f89949cb911bc190
