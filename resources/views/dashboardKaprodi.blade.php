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
        /* Buat Side bar */
        .sidebar {
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: #027683;
            min-height: 100vh;
            width: 280px;
        }
        .profile-img {
            width: 96px;
            height: 96px;
            background-color: #fef3c7;
        }

        /* Buat tulisan di side bar nya */
        .nav-link {
            color: white !important;
            font-family: 'Poppins';
            border-radius: 30px; /* Menambahkan kelengkungan pada navigasi */
            padding: 10px 15px;
            transition: background-color 0.3s ease; /* Transisi halus saat dihover */
        }

        /* Buat saat whilehover */
        .nav-link:hover {
            background-color: #359ca7;
            border-radius: 30px; /* Agar saat dihover, tetap rounded */
        }

        /* Buat saaat onclick */
        .nav-link.active {
            color: black !important;
            background-color: #F6DCAC !important;
            border-radius: 30px; /* Menjaga navigasi tetap rounded saat aktif */
        }

        /* Button Lonceng Notifikasi */
        .btn-notification {
            position: relative; /* Posisi relative untuk badge */
            background-color: #359ca7;
            border: 2px solid #027683; /* Warna border sesuai sidebar */
            border-radius: 50%; /* Membuatnya bulat */
            padding: 10px; /* Menambahkan padding untuk ukuran button */
            transition: background-color 0.3s ease; /* Transisi saat hover */
        }

        .btn-notification:hover {
            background-color: #5db0b9; /* Warna saat dihover */
        }

        /* Warna bulatan merah untuk notifikasi */
        .notification-badge {
            width: 15px; 
            height: 15px;
            background-color: #dc3545; /* Warna merah untuk notifikasi */
            border-radius: 50%;
            position: absolute;
            top: 0; /* Atur posisi vertikal */
            right: 0; /* Atur posisi horizontal */
            transform: translate(5%, -5%); /* Untuk memindahkan badge ke sudut tombol */
        }

        /* Buat pengumuman periode */
        .period-banner {
            background-color: #67C3CC;
        }

        .btn-logout {
            font-family: 'Poppins';
            background-color: #FED488;
            color: black;
        }
        
        .text-teal {
            color: white;
        }

        .text-konfirmasi{
            color: #028391;
        }

        .card{
            background: #FFF2E5;
            border-radius: 30px;
        }

    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4">
            <!-- Profile Section -->
            <div class="text-center mb-4">
                <div class="profile-img mb-3 mx-auto">
                    <!-- Placeholder for Profile Image -->
                </div>
                <h2 class="fs-5 fw-bold">{{ $data['kaprodi']['name'] }}</h2>
                <p class="small opacity-75">NIP. {{ $data['kaprodi']['nip'] }}</p>
                <p class="small opacity-75">{{ $data['kaprodi']['program_studi'] }}</p>
            </div>

            <!-- Navigation -->
            <nav class="nav flex-column gap-2">
                <a href="#" class="nav-link active rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">home</span>
                    Beranda
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">book</span>
                    Daftar Prodi
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">assessment</span>
                    Hasil Studi
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-logout mt-4 w-100 rounded-3">
                Keluar
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat Datang {{ $data['kaprodi']['name'] }} 👋</h1>
                    <p class="text-muted">Semester Akademik {{ $data['semester']['current'] }}</p>
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
                <span>{{ $data['semester']['period'] }}</span>
            </div>

            <!-- Cards Section -->
            <div class="row g-4 mb-4">
                <!-- Buat Jadwal Kuliah Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Buat Jadwal Kuliah</h5>
                            <p class="text-muted mb-3">Anda belum mengajukan jadwal</p>
                            <button class="btn btn-danger">Buat Jadwal</button>
                        </div>
                    </div>
                </div>

                <!-- Progress Mahasiswa Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Progress Mahasiswa</h5>
                            <div class="d-flex justify-content-around mt-3">
                                <div>
                                    <span class="fs-4 fw-bold text-danger">{{ $data['progressIRSMahasiswaKaprodi']['belumKonfirmasi']['count'] }}</span>
                                    <p class="small text-muted">Belum Konfirmasi</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-teal">{{ $data['progressIRSMahasiswaKaprodi']['sudahKonfirmasi']['count'] }}</span>
                                    <p class="small text-muted">Telah Konfirmasi</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-muted">{{ $data['progressIRSMahasiswaKaprodi']['belumIsiIRS']['count'] }}</span>
                                    <p class="small text-muted">Belum Mengisi IRS</p>
                                </div>
                                <div>
                                    <span class="fs-4 fw-bold text-muted">{{ $data['progressIRSMahasiswaKaprodi']['sudahIsiIRS']['count'] }}</span>
                                    <p class="small text-muted">Telah Mengisi IRS</p>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3">Lihat Detail</button>
                        </div>
                    </div>
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
