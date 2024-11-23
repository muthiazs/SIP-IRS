<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
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
            background-color: #028391;
        }
        .btn-cyan {
            background-color: #67C3CC;
        }
        .btn-cyan:hover {
            background-color: #028391;
        }
        .table thead th, .table tbody td {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 12px;
        }
        .d-flex.gap-3 {
            gap: 20px;
        }
    </style>
</head>
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
                    <p class="text-muted">Semester Akademik Sekarang</p>
                </div>
                <div class="position-relative">
                    <button class="btn btn-teal rounded-circle p-2">
                        <span class="material-icons">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Progress Cards -->
            <div class="card shadow-sm">
                <h5 class="card-header bg-teal text-white text-center">Pembagian Ruang Kelas</h5>
                <div class="card-body d-flex flex-column">
                    <div class="d-flex gap-3 text-center">
                        <!-- Dropdown Prodi -->
                        <div>
                            <div class="fw-bold">Program Studi</div>
                            <div class="dropdown">
                                <button class="btn btn-secondary text-white dropdown-toggle" type="button" id="dropdownMenuProdi" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Program Studi
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuProdi">
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Biologi</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Bioteknologi</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Fisika</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Kimia</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Matematika</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Informatika</a></li>
                                    <li><a class="dropdown-item dropdown-item-prodi" href="#">Statistika</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Dropdown Gedung -->
                        <div>
                            <div class="fw-bold">Gedung</div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuGedung" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Gedung
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuGedung">
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">A</a></li>
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">B</a></li>
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">C</a></li>
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">D</a></li>
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">E</a></li>
                                    <li><a class="dropdown-item dropdown-item-gedung" href="#">F</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang</th>
                                <th>Kapasitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelRuang">
                            @foreach($tabelRuang as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kapasitas }}</td>
                                <td>
                                    <button class="btn btn-primary mb-2">Tambah Ruang</button>
                                    <button class="btn btn-danger">Batalkan</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dropdown Logic -->
    <script>
        $(document).ready(function() {
            // Get initial selected gedung
            const initialGedung = $('#dropdownMenuGedung').text().trim().replace('Gedung ', '');
            if (initialGedung !== 'Pilih Gedung') {
                filterTabelByGedung(initialGedung);
            }
    
            // Untuk Dropdown Prodi
            $('.dropdown-item-prodi').on('click', function() {
                $('#dropdownMenuProdi').text($(this).text());
            });
    
            // Untuk Dropdown Gedung
            $('.dropdown-item-gedung').on('click', function() {
                const gedung = $(this).text();
                $('#dropdownMenuGedung').text('Gedung ' + gedung);
                
                // Filter tabel berdasarkan gedung yang dipilih
                filterTabelByGedung(gedung);
            });
        });
    
        function filterTabelByGedung(gedung) {
            $('#tabelRuang tr').each(function() {
                if ($(this).find('td').length) { // Skip header row
                    const namaRuang = $(this).find('td:eq(1)').text().trim();
                    
                    if (namaRuang.toLowerCase().startsWith(gedung.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }
    </script>
</body>
</html>