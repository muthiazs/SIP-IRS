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
    <style>
        .sidebar {
            background-color: #0d9488;
            min-height: 100vh;
            width: 280px;
        }
        .profile-img {
            width: 96px;
            height: 96px;
            background-color: #fef3c7;
        }
        .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            background-color: rgba(254, 243, 199, 0.1);
        }
        .nav-link.active {
            background-color: rgba(254, 243, 199, 0.2) !important;
        }
        .notification-badge {
            width: 8px;
            height: 8px;
            background-color: #dc3545;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
        }
        .period-banner {
            background-color: #99f6e4;
        }
        .btn-logout {
            background-color: #fef3c7;
            color: #0d9488;
        }
        .text-teal {
            color: #0d9488;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4 text-white position-relative">
            <!-- Profile Section -->
            <div class="text-center mb-4">
                <div class="profile-img rounded-circle mx-auto mb-3">
                    <!-- Profile image placeholder -->
                </div>
                <h2 class="fs-4 fw-bold">{{ $data['user']['name'] }}</h2>
                <p class="small opacity-75">NIP. {{ $data['user']['nip'] }}</p>
                <p class="small opacity-75">{{ $data['user']['program_studi'] }}</p>
            </div>

            <!-- Navigation -->
            <nav class="nav flex-column gap-2">
                <a href="#" class="nav-link active rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">home</span>
                    Beranda
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">description</span>
                    IRS Mahasiswa
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">
                Keluar
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat Datang {{ $data['user']['name'] }} 👋</h1>
                    <p class="text-muted">Semester Akademik Sekarang {{ $data['semester']['current'] }}</p>
                </div>
                <div class="position-relative">
                    <button class="btn btn-teal rounded-circle p-2">
                        <span class="material-icons text-white">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-teal">Periode Penyetujuan IRS</span>
                    <span class="text-teal fw-bold">{{ $data['semester']['period'] }}</span>
                </div>
            </div>

            <!-- Progress Cards -->
            <div class="row g-4 mb-4">
                <!-- Progress Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="fs-5 fw-semibold mb-4">Progress persetujuan IRS Mahasiswa</h3>
                            <div class="d-flex justify-content-between text-center">
                                <div>
                                    <div class="fs-4 fw-bold text-teal">
                                        {{ $data['progress']['disetujui']['count'] }}/{{ $data['progress']['disetujui']['total'] }}
                                    </div>
                                    <div class="small text-muted">IRS Disetujui</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-danger">
                                        {{ $data['progress']['ditolak']['count'] }}/{{ $data['progress']['ditolak']['total'] }}
                                    </div>
                                    <div class="small text-muted">IRS Ditolak</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-muted">
                                        {{ $data['progress']['pending']['count'] }}/{{ $data['progress']['pending']['total'] }}
                                    </div>
                                    <div class="small text-muted">Belum Ditinjau</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="fs-5 fw-semibold">Persetujuan IRS Mahasiswa</h3>
                                <span class="fs-4 text-danger">⚠️</span>
                            </div>
                            <p class="fs-6 fw-semibold mb-2">Anda belum selesai meninjau semua rencana studi</p>
                            <p class="text-muted mb-3">Silahkan lanjutkan peninjauan</p>
                            <button class="btn btn-primary">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="material-icons text-teal me-2">calendar_today</span>
                            <h3 class="fs-5 fw-semibold mb-0">Kalender Akademik</h3>
                        </div>
                        <button class="btn text-teal">
                            <span class="material-icons">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>