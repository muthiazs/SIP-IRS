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
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
        /* Tabel IRS */
        /* Mengubah warna header tabel */
        .table thead th {
            background-color: #FED488; /* Sesuaikan warna header */
            color: black; /* Teks putih */
            font-family: 'Poppins';
            text-align: center; /* Menengahkan teks */
            font-size: 12px;
        }

        .table tbody td {
            color: black; /* Teks putih */
            font-family: 'Poppins';
            text-align: center; /* Menengahkan teks */
            font-size: 12px;
        }

        /* Menambahkan roundness pada tabel */
        .table {
            border-radius: 10px; Sesuaikan besar roundness
            overflow: hidden; /* Menghindari isi tabel keluar dari roundness */
            table-layout: fixed; /* Ukuran kolom tetap */
            width: 100%; /* Pastikan tabel mengambil seluruh lebar kontainer */
        }
        
        .table th, .table td {
            word-wrap: break-word; /* Agar teks yang panjang tidak melar keluar kolom */
            text-align: center; /* Pusatkan teks */
        }

        /* Roundness untuk header */
        /* .table thead th:first-child {
            border-top-left-radius: 10px;
        } */
        /* .table thead th:last-child {
            border-top-right-radius: 10px;
        } */
        
        /* Roundness untuk footer jika dibutuhkan */
        .table tfoot td:first-child {
            border-bottom-left-radius: 10px;
        }
        .table tfoot td:last-child {
            border-bottom-right-radius: 10px;
        }
        .button-group-right {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Jarak antar tombol */
            margin-top: 15px; /* Jarak dari elemen atas */
            margin-bottom: 15px;
            margin-right: 15px; 
        }
        .button-group-tabel {
            display: flex;
            justify-content: center;
            gap: 5px; /* Jarak antar tombol */
            /* margin-top: 15px; /* Jarak dari elemen atas */
            /* margin-bottom: 15px;
            margin-right: 15px;  */ */
        }

        /* Adjust search bar size */
        .searchInput {
            max-width: 300px; /* Sesuaikan ukuran maksimal */
        }

        /* Optional: Add spacing between buttons */
        .input-group .btn {
            margin-left: 5px; /* Tambahkan jarak antar tombol */
        }

        .card-body {
            overflow-x: auto; /* Agar tabel tidak keluar dari card */
            padding: 15px; /* Tambahkan padding agar terlihat rapi */
            width: auto; /* Sesuaikan lebar dengan konten */
            max-width: 100%; /* Pastikan tidak melebihi layar */
            box-sizing: border-box; /* Hitung padding dalam ukuran elemen */
        }

        .card {
            width: auto; /* Sesuaikan ukuran card dengan kontennya */
            max-width: 100%; /* Agar tidak melebihi layar */
        }


    </style> 
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- untuk manggil komponen sidebar -->
        <x-sidebar-mahasiswa :mahasiswa="$mahasiswa"></x-sidebar-mahasiswa>
        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1>{{$Periode_sekarang->jenis}}</h1>
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
                                <span class="badge irs-badge" style="background-color: #67C3CC;">0 SKS</span>
                            </div>
                            <div class="margincard" style="margin-left: 10px;">
                                <div class="fw-bold" style="font-size: 12px;">TOTAL SKS</div>
                                <span class="badge irs-badge" style="background-color: #67C3CC;">0 SKS</span>
                            </div>
                        </div>
                        <div>
                            <div class="margincard">
                                <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-2">
                        <!-- Search bar -->
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari Mata Kuliah" aria-label="Search" aria-describedby="button-addon2" style="max-width: 300px;">
                        <button class="btn" style="background-color: #6878B1; color:#fff" type="button" id="button-addon2">
                            <span class="material-icons">search</span>
                        </button>
                        <!-- Filter buttons -->
                        <div>
                            <button class="btn custom-btn-primary" id="resetFilter">Semua</button>
                            <button class="btn custom-btn-outline" id="filterGenap">Semester Genap</button>
                            <button class="btn custom-btn-outline" id="filterGanjil">Semester Ganjil</button>
                        </div>
                    </div>
                                    
                    <div class="banner text-center mt-2 rounded-top" 
                        style="background-color: #027683; 
                                color: white; 
                                height: 40px; /* Tinggi banner */
                                display: flex; /* Mengaktifkan Flexbox */
                                justify-content: center; /* Pusat horizontal */
                                align-items: center; /* Pusat vertikal */ 
                                font-size: 18px;">
                        <span class="fw-medium">Daftar Jadwal Kuliah</span>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3rem;">No</th>
                                <th style="width: 5rem;">Kode MK</th>
                                <th style="width: 6rem;">Mata Kuliah</th>
                                <th style="width: 5rem;">Semester</th>
                                <th style="width: 4rem;">Kelas</th>
                                <th style="width: 4rem;">SKS</th>
                                <th style="width: 4rem;">Ruang</th>
                                <th style="width: 5rem;">Hari</th>
                                <th style="width: 6rem;">Jam Mulai</th>
                                <th style="width: 6rem;">Jam Selesai</th>
                                <th style="width: 4rem;">Kuota</th>
                                <th style="width: 7rem;">Aksi</th>
                            </tr>
                        </thead>                
                    <tbody id="irsTable">
                        @foreach($jadwalKuliah as $index => $jadwal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jadwal->kode_matkul }}</td>
                            <td>{{ $jadwal->nama_matkul }}</td>
                            <td>{{ $jadwal->semester }}</td>
                            <td>{{ $jadwal->kelas }}</td>
                            <td>{{ $jadwal->sks }}</td>
                            <td>{{ $jadwal->namaruang }}</td>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_selesai }}</td>
                            <td>{{ $jadwal->kuota }}</td>
                            <td>
                                <div class="button-group-tabel">
                                    <div class="button-group-tabel">
                                        <a class="btn mb-2 rounded-3" style="color:white; background-color: #67C3CC; font-size: 10px; padding: 5px 10px;" id="ambilBtn">Ambil</a>
                                    </div>
                                    <div class="button-group-tabel">
                                        <a class="btn btn-danger mb-2 rounded-3" style="font-size: 10px; padding: 5px 10px;" id="batalkanBtn">Batal</a>
                                    </div>
                                </div>
                            </td>                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="button-group-right">
                    <div class="button-group-right">
                        <a href="{{ route('mhs_newIRS') }}" class="btn" style="color:white; background-color:#FFB939">Keluar</a>
                    </div>
                    <div class="button-group-right">
                        <a href="{{ route('mhs_draftIRS') }}" class="btn" style="color: white; background-color: #6878B1">Lanjutkan</a>
                    </div>
                </div>
            </div> 
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari Mata Kuliah" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
            </div>
                
            <div class="period-banner mb-1 text-center font-size: 12px" style="background-color: #027683; color: white;">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="fw-medium">Daftar Jadwal Kuliah</span>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 3rem;">No</th>
                        <th style="width: 5rem;">Kode MK</th>
                        <th style="width: 6rem;">Mata Kuliah</th>
                        <th style="width: 5rem;">Semester</th>
                        <th style="width: 4rem;">Kelas</th>
                        <th style="width: 4rem;">SKS</th>
                        <th style="width: 4rem;">Ruang</th>
                        <th style="width: 5rem;">Hari</th>
                        <th style="width: 6rem;">Jam Mulai</th>
                        <th style="width: 6rem;">Jam Selesai</th>
                        <th style="width: 4rem;">Kuota</th>
                        <th style="width: 10rem;">Aksi</th>
                    </tr>
                </thead>                
            <tbody id="irsTable">
                @foreach($jadwalKuliah as $index => $jadwal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jadwal->kode_matkul }}</td>
                    <td>{{ $jadwal->nama_matkul }}</td>
                    <td>{{ $jadwal->semester }}</td>
                    <td>{{ $jadwal->kelas }}</td>
                    <td>{{ $jadwal->sks }}</td>
                    <td>{{ $jadwal->namaruang }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>{{ $jadwal->kuota }}</td>
                    <td>
                        <div class="button-group-tabel">
                            <div class="button-group-tabel">
                                <form action="{{ route('ambilJadwal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">
                                <input type="hidden" name="status" value="draft"> <!-- Or other status value -->
                                <button type="submit" class="btn btn-primary mb-2 rounded-3">Ambil</button>
                                </form>
                            </div>
                            <div class="button-group-tabel">
                                <a class="btn btn-danger mb-2 rounded-3" id="batalkanBtn">Batal</a>
                            </div>
                        </div>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="button-group-right">
            <div class="button-group-right">
                <a href="{{ route('mhs_newIRS') }}" class="btn btn-warning">Keluar</a>
            </div>
            <div class="button-group-right">
                <a href="{{ route('mhs_draftIRS') }}" class="btn btn-info">Lanjutkan</a>
            </div>
        </div>
        </div>
    </div>
  </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Menangani klik tombol Ambil
    document.getElementById('ambilBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Ambil Mata Kuliah',
            text: 'Apakah Anda yakin ingin mengambil mata kuliah ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ambil!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aksi yang terjadi setelah konfirmasi, bisa diarahkan ke route
                window.location.href = '#'; // Ganti dengan route yang sesuai
            }
        });
    });

    // Menangani klik tombol Batalkan
    document.getElementById('batalkanBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Batalkan Mata Kuliah',
            text: 'Apakah Anda yakin ingin membatalkan pengambilan mata kuliah ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aksi yang terjadi setelah konfirmasi, bisa diarahkan ke route
                window.location.href = '#'; // Ganti dengan route yang sesuai
            }
        });
    });
</script>

{{-- Menangani searching --}}
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        // Ambil nilai input dan ubah ke huruf kecil untuk pencarian tidak case-sensitive
        const searchValue = this.value.toLowerCase();

        // Ambil semua baris tabel di tbody
        const rows = document.querySelectorAll('#irsTable tr');

        // Loop melalui setiap baris untuk mencocokkan nilai
        rows.forEach(row => {
            // Ambil kolom "Mata Kuliah" (kolom ketiga, indeks ke-2)
            const mataKuliah = row.cells[2].textContent.toLowerCase();

            // Jika teks kolom mengandung nilai pencarian, tampilkan baris
            if (mataKuliah.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<script>
    // Tombol untuk filter semester genap
    document.getElementById('filterGenap').addEventListener('click', function () {
        const rows = document.querySelectorAll('#irsTable tr');
        rows.forEach(row => {
            const semester = parseInt(row.cells[3].textContent.trim()); // Ambil nilai semester dari kolom ke-4
            if (semester % 2 === 0) { // Jika semester genap
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    });

    // Tombol untuk filter semester ganjil
    document.getElementById('filterGanjil').addEventListener('click', function () {
        const rows = document.querySelectorAll('#irsTable tr');
        rows.forEach(row => {
            const semester = parseInt(row.cells[3].textContent.trim()); // Ambil nilai semester dari kolom ke-4
            if (semester % 2 !== 0) { // Jika semester ganjil
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    });

    // Tombol untuk reset filter
    document.getElementById('resetFilter').addEventListener('click', function () {
        const rows = document.querySelectorAll('#irsTable tr');
        rows.forEach(row => {
            row.style.display = ''; // Tampilkan semua baris
        });
    });
</script>
