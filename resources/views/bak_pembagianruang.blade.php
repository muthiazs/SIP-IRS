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
     <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
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
<body>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <x-sidebar-akademik :akademik="$akademik"></x-sidebar-akademik>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat Datang {{ $akademik->nama }} 👋</h1>
                    <p class="text-muted">Semester Akademik Sekarang </p>
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
                    <span class="text-white">Periode Pembagian Ruang Kelas</span>
                    <span class="text-white fw-bold">a</span>
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
                                <button class="btn btn-secondary text-white dropdown-toggle" type="button" id="dropdownMenuHari" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuGedung" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Gedung
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuGedung">
                                    <li><a href="#">A</a></li>
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