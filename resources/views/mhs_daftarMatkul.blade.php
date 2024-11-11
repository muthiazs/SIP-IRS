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

            

            <div class="period-banner mb-1 text-center font-size: 12px" style="background-color: #027683; color: white;">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="fw-medium">Daftar Mata Kuliah</span>
                </div>
            </div>

            <table class="table table-bordered">
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
    </div>
  </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>