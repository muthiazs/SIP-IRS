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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
            border-radius: 10px; /*Sesuaikan besar roundness*/
            overflow: hidden; /*Menghindari isi tabel keluar dari roundness */
            table-layout: fixed; /* Ukuran kolom tetap */
            width: 100%; /* Pastikan tabel mengambil seluruh lebar kontainer */
            padding: 10px;
        }
        
        .table th, .table td {
            word-wrap: break-word; /* Agar teks yang panjang tidak melar keluar kolom */
            text-align: center; /* Pusatkan teks */
        }
      /* Styling untuk DataTables */
      .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #027683 !important;
            color: white !important;
            border: 1px solid #027683 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #67C3CC !important;
            color: white !important;
            border: 1px solid #67C3CC !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .dataTables_wrapper .dataTables_paginate {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            margin-top: 10px;
        }

        /* Table responsive tanpa geser */
        .table-responsive {
            overflow-x: auto;
            max-width: 100%; /* Agar tabel tetap berada dalam kontainer */
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
            </div>

            <!-- Progress Cards -->
            <div class="card shadow-sm">
                <h5 class="card-header bg-teal text-white text-center">Tinjau dan Hapus Ruang Kelas</h5>
                <div class="card-body d-flex flex-column">
                    <div class="d-flex gap-3 text-center">
                        <!-- Dropdown Prodi -->
                        <!-- Dropdown Gedung -->
                        <div>
                            <div class="fw-bold mb-2">Gedung</div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuGedung" data-bs-toggle="dropdown" aria-expanded="false">
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

                    <table class="table table-bordered mt-4" id="cekTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang</th>
                                <th>Kapasitas</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="statusRuang">
                            @foreach($statusRuang as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kapasitas }}</td>
                                <td>{{ $data->nama_prodi }}</td>
                                <td>
                                    <button class="btn btn-primary mb-2" onclick="window.location.href='{{ route('bak_NextUpdateDeleteRuang') }}'">Batalkan</button>
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
            $('#statusRuang tr').each(function() {
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#cekTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json',
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: -1 }  // Nonaktifkan sorting untuk kolom aksi
                ],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });
        });
    </script>
</body>
</html>