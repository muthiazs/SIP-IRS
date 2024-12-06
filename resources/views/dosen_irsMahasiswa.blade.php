<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS IRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
       .wrapper {
            display: flex;
            min-height: 100vh;
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

        .filter-search {
            gap: 10px; /* Jarak antara filter dropdown dan search bar */
        }
        .filter-search .form-select {
            width: 200px; /* Lebar dropdown */
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <x-sidebar-dosen :dosen="$dosen"></x-sidebar-dosen>
        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <header class="header">
                <div>
                    <h1 class="fs-3 fw-bold">IRS Mahasiswa👩🏻‍💻</h1>
                    <p class="text-muted">Semester Akademik Sekarang </p>
                </div>
            </header>
            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-teal">Periode Penyetujuan IRS</span>
                    <span class="text-teal fw-bold">...-...</span>
                </div>
            </div>
           <!-- Filter and Search -->
            <section class="filter-search mt-2 d-flex justify-content-between align-items-center">
                <!-- Search by Nama -->
                <div class="search-group">
                    <input type="text" id="search-input" class="form-control" placeholder=" 🔍 Cari nama">
                </div>
            </section>
            <!-- Student List -->
           <!-- Bagian yang sudah ada dari template Anda -->
           <section class="student-list mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Angkatan</th>
                        <th>Prodi</th>
                        <th>Total Usulan</th>
                        <th>Status Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="student-list">
                    @foreach($usulanIRS as $index => $irs)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input student-checkbox">
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $irs->nama_mahasiswa }}</td>
                            <td>{{ $irs->nim }}</td>
                            <td>{{ $irs->angkatan }}</td>
                            <td>{{ $irs->prodi_nama }}</td>
                            <td>{{ $irs->total_usulan }}</td>
                            <td>
                                <span class="badge 
                                    @if($irs->status_terakhir == 'belum disetujui') bg-warning 
                                    @elseif($irs->status_terakhir == 'disetujui') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ $irs->status_terakhir }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('dosen_detailIRSMahasiswa', ['nim' => $irs->nim]) }}" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>                                                                        
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>        
        </div>
    </div>
        <!-- Footer -->
        <footer>
            <p>&copy; 2024 IRS Mahasiswa</p>
        </footer>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const studentRows = document.querySelectorAll('#student-list tr'); // Target all rows in the table

                // Filter function
                function filterStudents() {
                    const searchTerm = searchInput.value.toLowerCase();

                    studentRows.forEach(row => {
                        const nameCell = row.querySelector('td:nth-child(3)'); // Nama Mahasiswa
                        const studentName = nameCell ? nameCell.textContent.toLowerCase() : '';

                        // Toggle row visibility based on search match
                        if (studentName.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                // Attach event listeners
                searchInput.addEventListener('input', filterStudents);

                // Initial filter run
                filterStudents();

    // Logout function
    function logout() {
            alert('Logout button clicked!');
            // Add your logout logic here
        }
});
        </script>
</body>

</html>