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
        .sidebar {
            background-color: #028391;
            min-height: 100vh;
            width: 280px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
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
            background-color: #FED488 !important;
            color: #000000 !important; 
        }
        .notification-badge {
            width: 15px;
            height: 15px;
            background-color: #dc3545;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
        }
        .period-banner {
            background-color: #67C3CC;
        }
        .btn-logout {
            background-color: #FED488;
            color: #028391;
            justify-content: flex-end;
        }
        .btn-logout:hover {
            background-color: #FED488;
            color: #028391;
            justify-content: flex-end;
        }
        .text-teal {
            color: #028391;
        }
        .btn-blue {
            background-color: #6878B1;
            color: #ffffff;
        }
        /* .material-icons {
            color: #ffffff;
        }
        .material-icons.active {
            color: #000000 !important;
        } */
        .btn-teal {
            width: 45px;
            height: 45px;
            background-color: #028391;
            color: #ffffff;
        }
        .text-blue {
            color: #456DDB;
        }
        .card-body {
            background-color: #FFF2E5;
        }
        .bg-teal {
            background-color: #028391
        }

        .margincard {
            margin-right: 10px;
        }
        .btn-cyan {
            background-color: #67C3CC;
        }
        .btn-cyan:hover {
            background-color: #028391;
        }
        .btn-cyan:hover {
            background-color: #028391;
        }
        .dropdown-item-gedung .active {
            background-color: #67C3CC;
            color: #000000;
        }
        .dropdown-item-gedung:hover {
            background-color: #67C3CC;
            color: #fff;
        }
        .dropdown-menu li:hover {
            background-color: #67C3CC;
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
                <p class="small opacity-75">{{ $data['user']['role'] }}</p>
                <p class="small opacity-75">{{ $data['user']['periode'] }}</p>
            </div>

            <!-- Navigation -->
            <nav class="nav flex-column gap-2">
                <a href="/dashboardAkademik" class="nav-link rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">home</span>
                    Beranda
                </a>
                <a href="/pembagianruang" class="nav-link active rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">class</span>
                    Pembagian Ruang
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">
                <a href="/login" class="nav-link active">
                    Keluar
                </a> 
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
                        <span class="material-icons text-">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white">Periode Pemebagian Ruang Kelas</span>
                    <span class="text-white fw-bold">{{ $data['semester']['period'] }}</span>
                </div>
            </div>

            <!-- Progress Cards -->
                    <div class="card shadow-sm">
                        <h5 class="card-header bg-teal text-white text-center">Pembagian Ruang Kelas</h5>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex text-center">
                                <div class="margincard">
                                    <div class="fw-bold">Hari</div>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary text-white dropdown-toggle" type="button" id="dropdownMenuHari"   
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                          Pilih Hari
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuHari">
                                          <li class="dropdown-item-hari">Senin</li>
                                          <li class="dropdown-item-hari">Selasa</li>
                                          <li class="dropdown-item-hari">Rabu</li>
                                          <li class="dropdown-item-hari">Kamis</li>
                                          <li class="dropdown-item-hari">Jumat</li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-bold">Gedung</div>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuGedung"   
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                          Pilih Gedung
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuGedung">
                                          <li><a  href="#">A</a></li>
                                          <li class="dropdown-item-gedung">B</li>
                                          <li class="dropdown-item-gedung">C</li>
                                          <li class="dropdown-item-gedung">D</li>
                                          <li class="dropdown-item-gedung">E</li>
                                          <li class="dropdown-item-gedung">F</li>
                                          <li class="dropdown-item-gedung">G</li>
                                          <li class="dropdown-item-gedung">H</li>
                                          <li class="dropdown-item-gedung">I</li>
                                          <li class="dropdown-item-gedung">J</li>
                                          <li class="dropdown-item-gedung">K</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-blue">Lihat Detail</button>
                        </div>
                    </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const dropdownButtonHari = document.getElementById('dropdownMenuHari');
        const dropdownItem = document.querySelectorAll('.dropdown-item-hari');
      
        dropdownItem.forEach(item => {
            item.addEventListener('click', () => {
                dropdownButtonHari.textContent = item.textContent;
            });
        });
    </script>

    <script>
        const dropdownButton = document.getElementById('dropdownMenuGedung');
        const dropdownItems = document.querySelectorAll('.dropdown-item-gedung');
    
            dropdownItems.forEach(item => {
            item.addEventListener('click', () => {
                dropdownButton.textContent = item.textContent;
            });
        });
    </script>

</body>
</html>