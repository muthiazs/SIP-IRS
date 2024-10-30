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
    <!-- Buat ubah font jadi poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d9488;
            --secondary-color: #99f6e4;
            --accent-color: #fef3c7;
        }

        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            width: 280px;
            color: white;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            background-color: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .nav-link {
            color: white !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .status-card {
            background-color: var(--accent-color);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .stats-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .period-banner {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 10px;
            padding: 15px 20px;
        }

        .btn-logout {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            opacity: 0.9;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .wave-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            opacity: 0.1;
        }
    </style> <style>
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
            background-color: #5db0b9;
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
            right: 50px;
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
        <div class="sidebar p-4 text-white position-relative">
            <!-- Profile Section -->
            <div class="text-center mb-4">
                <div class="profile-img rounded-circle mx-auto mb-3">
                    <!-- Profile image placeholder -->
                </div>
                <h2 class="fs-4 fw-bold">{{ $data['dekan']['name'] }}</h2>
                <p class="small opacity-75">NIP. {{ $data['dekan']['nip'] }}</p>
                <p class="small opacity-75">{{ $data['dekan']['program_studi'] }}</p>
            </div>

        <!-- Navigation -->
        <nav class="nav flex-column gap-2">
            <a href="#" class="nav-link active rounded d-flex align-items-center p-3">
                <span class="material-icons me-2">home</span>
                Beranda
            </a>
            <a href="#" class="nav-link rounded d-flex align-items-center p-3">
                <span class="material-icons me-2">check_circle</span>
                Persetujuan Ruang
            </a>
            <a href="#" class="nav-link rounded d-flex align-items-center p-3">
                <span class="material-icons me-2">event</span>
                Persetujuan Jadwal Kuliah
            </a>
        </nav>


            <!-- Logout Button -->
            <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">
                Keluar
            </button>
        </div>

        <!-- Wave decoration -->
        <div class="wave-decoration">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat Datang {{ $data['dekan']['name'] }} 👋</h1>
                    <p class="text-muted">Semester Akademik Sekarang {{ $data['semester']['current'] }}</p>
                </div>
                <div class="position-relative">
                    <!-- Button Notifikasi -->
                    <button class="btn btn-notification rounded-circle p-2">
                        <span class="material-icons text-white">notifications</span>
                    </button>
                    <span class="notification-badge"></span> <!-- Bulatan merah notifikasi -->
                </div>
            </div>


            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="text-teal">Periode Penyetujuan Jadwal Kuliah</span>
                        <span class="text-teal">Periode Penyetujuan Ruang Kelas</span>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <span class="text-teal fw-bold">{{ $data['semester']['period'] }}</span> <!-- Tanggal periode jadwal kuliah -->
                        <span class="text-teal fw-bold">{{ $data['semester']['period'] }}</span> <!-- Tanggal periode ruang kelas -->
                    </div>
                </div>
            </div>

            <!-- Progress Cards Jadwal Kuliah-->
            <div class="row g-4 mb-4">
                <!-- Progress Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="fs-5 fw-semibold mb-4">Progress persetujuan Jadwal Kuliah</h3>
                            <div class="d-flex justify-content-between text-center">
                                <div>
                                    <div class="fs-4 fw-bold text-danger">
                                        {{ $data['progress']['belum_mengusulkan']['count'] }}/{{ $data['progress']['belum_mengusulkan']['total'] }}
                                    </div>
                                    <div class="small text-muted">Belum<br>Mengusulkan</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-konfirmasi">
                                        {{ $data['progress']['telah_dikonfirmasi']['count'] }}/{{ $data['progress']['telah_dikonfirmasi']['total'] }}
                                    </div>
                                    <div class="small text-">Telah<br>Dikonfirmasi</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-muted">
                                        {{ $data['progress']['belum_dikonfirmasi']['count'] }}/{{ $data['progress']['belum_dikonfirmasi']['total'] }}
                                    </div>
                                    <div class="small text-muted">Belum<br>Dikonfirmasi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proggress Persetujuan Ruang Kuliah -->
                <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h3 class="fs-5 fw-semibold text-center">Persetujuan Ruang Kuliah</h3>
                                </div>
                                <p class="fs-6 fw-semibold mb-2">Anda belum mendapat usulan ruang kuliah</p>
                                <p class="text-muted mb-3">Silahkan kembali beberapa saat kedepan</p>
                                <button class="btn btn-danger">
                                    Lihat Detail
                                </button>
                                </div>
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
