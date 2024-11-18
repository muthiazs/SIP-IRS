<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
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
                <div class="position-relative">
                    <button class="btn btn-teal rounded-circle p-2">
                        <span class="material-icons text-white">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4 d-flex justify-content-between">
                <span>Periode Persetujuan Ruang Kelas</span>
                <span>a</span>
            </div>

            <!-- Progress Mahasiswa -->
            <h3 class="fw-bold mb-4">Progress Mahasiswa</h3>
            <div class="card mb-4 p-3">
                <h5 class="fw-bold mb-3">Program Studi Informatika</h5>
                <div class="row text-center">
                    <div class="col-3">
                        <h6 class="fw-bold text-danger">10</h6>
                        <p class="text-muted">Mangkir</p>
                    </div>
                    <div class="col-3">
                        <h6 class="fw-bold text-dark">10</h6>
                        <p class="text-muted">Cuti</p>
                    </div>
                    <div class="col-3">
                        <h6 class="fw-bold text-primary">50</h6>
                        <p class="text-muted">Belum Konfirmasi</p>
                    </div>
                    <div class="col-3">
                        <h6 class="fw-bold text-success">100</h6>
                        <p class="text-muted">Telah Konfirmasi</p>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary rounded-pill px-4">Lihat Detail</button>
                </div>
            </div>

            <!-- Status Pengisian IRS -->
            <h3 class="fw-bold mb-4">Status Pengisian IRS</h3>
            <div class="card p-3">
                <h5 class="fw-bold mb-3">Status Pengisian IRS</h5>
                <div class="row text-center">
                    <div class="col-4">
                        <h6 class="fw-bold text-danger">20</h6>
                        <p class="text-muted">Belum Konfirmasi</p>
                    </div>
                    <div class="col-4">
                        <h6 class="fw-bold text-primary">30</h6>
                        <p class="text-muted">Telah Konfirmasi</p>
                    </div>
                    <div class="col-4">
                        <h6 class="fw-bold text-success">100</h6>
                        <p class="text-muted">Telah Mengisi IRS</p>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary rounded-pill px-4">Lihat Detail</button>
                </div>
            </div>

            <!-- Kalender Akademik -->
            <div class="card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="material-icons text-teal me-2">calendar_today</span>
                        <h5 class="fw-bold mb-0">Kalender Akademik</h5>
                    </div>
                    <button class="btn text-teal">
                        <span class="material-icons">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
