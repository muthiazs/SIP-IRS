<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengisian Rencana Studi - SIP-IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #027683;
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
            color: black !important;
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

        /* Background Warna */
        .bg-teal {
            background-color: #027683 
        }
        .bg-cyan {
            background-color: #359ca7
        }

        /* Badge Pengisian IRS */
        .irs-badge { /* Untuk max beban & total sks */
            font-size: 14px;
            padding: 0.4rem 2.7rem;
            border-radius: 5px;
        }

        .btn-outline-blue {
            outline-color: #6878B1
            
        }

        /* Button Pilih Matkul */
        .btn-pilihmk {

        }

        /* Tabel IRS */
        /* Mengubah warna header tabel */
        .table thead th {
            background-color: #FED488; /* Sesuaikan warna header */
            color: black; /* Teks putih */
            font-family: 'Poppins';
            text-align: center; /* Menengahkan teks */
            font-size: 12px;
        }
        
        /* Menambahkan roundness pada tabel */
        .table {
            border-radius: 10px; /* Sesuaikan besar roundness */
            overflow: hidden; /* Menghindari isi tabel keluar dari roundness */
        }
        
        /* Roundness untuk header */
        .table thead th:first-child {
            border-top-left-radius: 10px;
        }
        .table thead th:last-child {
            border-top-right-radius: 10px;
        }
        
        /* Roundness untuk footer jika dibutuhkan */
        .table tfoot td:first-child {
            border-bottom-left-radius: 10px;
        }
        .table tfoot td:last-child {
            border-bottom-right-radius: 10px;
        }

    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        @include ('sidebar')
        {{-- <div class="sidebar p-4 position-relative">
            <div class="text-center mb-4">
                <div class="profile-img mb-3">
                    <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
                </div>
                <h5 class="mb-1">{{ $mahasiswa->nama_mhs }}</h5>
                <p class="small mb-1">NIM. {{ $mahasiswa->nim }}</p>
                <p class="small mb-1">{{ $mahasiswa->prodi_nama}}</p>
                <p class="small mb-1">{{ $mahasiswa->nama_doswal }}</p>
                <p class="small">NIP. {{ $mahasiswa->nip }}</p>
            </div>

            <nav class="nav flex-column gap-2 mb-4">
                <a href="/dashboardMahasiswa" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">home</span>
                    Beranda
                </a>
                <a href="/rencanaStudi" class="nav-link active rounded d-flex align-items-center">
                    <span class="material-icons me-3">description</span>
                    Rencana Studi
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">assessment</span>
                    Hasil Studi
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">
                <a href="/login">
                    <span class="material-icons align-middle me-2">logout</span>
                    Keluar
                </a>
            </button>

             <!-- Wave decoration -->
             <div class="wave-decoration">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 200%; width: 175%;">
                    <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
                </svg>
            </div>
        </div> --}}

        <!-- Main Content -->
        
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Selamat Datang {{ $mahasiswa->username }} 👋</h1>
                    <p class="text-muted mb-0">Semester Akademik Sekarang</p>
                </div>
                <div class="position-relative">
                    <button class="btn btn-primary rounded-circle p-2">
                        <span class="material-icons">notifications</span>
                    </button>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">Notifikasi baru</span>
                    </span>
                </div>
            </div>

             <!-- Pengisian IRS Cards -->
        <div class="col-12">
            <div class="card shadow-sm h-100">
              <h5 class="card-header" style="background-color: #027683; color: white;">Pengisian Rencana Studi</h5>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="margincard">
                            <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;">$data['pengisianirs']['maxbeban'] SKS</span>
                        </div>
                        <div class="margincard" style="margin-left: 10px;">
                            <div class="fw-bold" style="font-size: 12px;">TOTAL SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;"> $data['pengisianirs']['total'] SKS</span>
                        </div>
                    </div>
                    <div>
                        <div class="margincard">
                            <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            <button class="btn btn-pilihmk">
                                <a href="/pengambilanMatkul" class="nav-link active">
                                    Pilih Mata Kuliah
                                </a> 
                            </button>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Period Banner -->
            <div class="period-banner mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">Periode Pengisian IRS</span>
                    <span class="fw-medium">$data['semester']['period'] </span>
                </div>
            </div>

            <div class="period-banner mb-1 text-center font-size: 12px" style="background-color: #027683; color: white;">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="fw-medium">Daftar Mata Kuliah</span>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="irsTable">
                    @foreach($daftarMk as $index => $daftarM)  <!-- Gunakan nama yang sama, 'daftarMk' -->
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $daftarM->kode_matkul }}</td>
                        <td>{{ $daftarM->nama_matkul }}</td>
                        <td>{{ $daftarM->semester }}</td>
                        <td>{{ $daftarM->sks }}</td>
                        <td><input type="checkbox" name="selected_matkul[]" value="{{ $daftarM->kode_matkul }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


       

            

            {{-- <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                  <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari Mata Kuliah" aria-label="Search">
                    <button class="btn btn-outline-blue" type="submit" style="background-color: #6878B1; color: white">Cari</button>
                  </form>
                </div>
            </nav> --}}

            {{-- <div class="card-body">
                <table class="table table-borderless" style="background-color: #fef3c7">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>06.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>07.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>08.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>09.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>10.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>11.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>12.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>13.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>14.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>15.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>16.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>17.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>18.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div> --}}
        {{-- </div> --}}
    </div>
  </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>