<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard Kaprodi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
    <x-sidebar-kaprodi :kaprodi="$kaprodi"></x-sidebar-kaprodi>
            <!-- Wave decoration -->
            <div class="wave-decoration"> 
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                    <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
                </svg>
            </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat datang, {{ $kaprodi->username }} 👋</h1>
                    <p class="text-muted">Semester Akademik sekarang</p>
                </div>
            </div>

                    <!-- Period Banner -->
                <div class="alert alert-success" role="alert">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-medium">
                            Masa Pengaturan Jadwal: 
                            @if($masaAturJadwal)
                                {{ $masaAturJadwal->nama_kegiatan }} 
                                ({{ $masaAturJadwal->tanggal_mulai }} - {{ $masaAturJadwal->tanggal_selesai }})
                            @else
                                Tidak ada periode pengaturan jadwal yang aktif
                            @endif
                        </span>
                    </div>
                </div>






            <!-- Cards Section -->
            <div class="row g-4 mb-4">
                <!-- Buat Jadwal Kuliah Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Buat Jadwal Kuliah</h5>
                            <p class="text-muted mb-3">Anda belum mengajukan jadwal</p>
                            <a href="/kaprodi_JadwalKuliah">
                                <button class="btn btn-danger">Buat Jadwal</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Progress Mahasiswa Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Progress Mahasiswa</h5>
                            <div class="d-flex justify-content-around mt-3">
                                <!-- ini aku buat biar kita bisa liat tampilan klo datanya udah ada, aku ngecek side bar pake iniiii -->
                                <div>
                                        <span class="fs-4 fw-bold text-danger">1 / 1 </span>
                                        <p class="small text-muted">Belum Konfirmasi</p>
                                    </div>
                                    <div>
                                        <span class="fs-4 fw-bold text-konfirmasi">1 / 1</span>
                                        <p class="small text-muted">Telah Konfirmasi</p>
                                    </div>
                                    <div>
                                        <span class="fs-4 fw-bold text-danger">1 / 1 </span>
                                        <p class="small text-muted">Belum Mengisi IRS</p>
                                    </div>
                                    <div>
                                        <span class="fs-4 fw-bold text-konfirmasi"> 1 / 1</span>
                                        <p class="small text-muted">Telah Mengisi IRS</p>
                                    </div>
                                </div>
                                <!-- <div>
                                    <span class="fs-4 fw-bold text-danger">$data['progressIRSMahasiswaKaprodi']['belumKonfirmasi']['count'] </span>
                                    <p class="small text-muted">Belum Konfirmasi</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-konfirmasi">$data['progressIRSMahasiswaKaprodi']['sudahKonfirmasi']['count']</span>
                                    <p class="small text-muted">Telah Konfirmasi</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-danger">$data['progressIRSMahasiswaKaprodi']['belumIsiIRS']['count'] </span>
                                    <p class="small text-muted">Belum Mengisi IRS</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-konfirmasi"> $data['progressIRSMahasiswaKaprodi']['sudahIsiIRS']['count']</span>
                                    <p class="small text-muted">Telah Mengisi IRS</p>
                                </div>
                            </div> -->
                            <a href="/kaprodi_StatusMahasiswa">
                                <button class="btn btn-primary mt-3">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kalender Akademik -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="material-icons text-teal me-2" style="color: blue">calendar_today</span>
                            <h3 class="fs-5 fw-semibold mb-0">Kalender Akademik</h3>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('kalender_akademik') }}" class="btn btn-outline-primary me-2">Lihat Kalender</a>
                            <button class="btn text-teal">
                                <span class="material-icons">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>








