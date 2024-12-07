<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS IRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
     <!-- Add DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
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
            <div class="alert alert-success" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">
                        Periode Penyetujuan IRS: 
                        {{ $fetchPeriodeSetujuIRS->tanggal_mulai }} - {{ $fetchPeriodeSetujuIRS->tanggal_selesai }}
                    </span>
                </div>
            </div>
            <section class="filter-search mt-2 d-flex justify-content-between align-items-center">
                <!-- Search by Nama -->
                <div class="search-group">
                    <input type="text" id="search-input" class="form-control" placeholder=" 🔍 Cari nama">
                </div>
            </section>
            <!-- Setujui IRS Button -->
            <div class="approve-group">
                <button id="approve-btn" class="btn btn-success">Setujui IRS yang Dipilih</button>
            </div>
            <!-- Student List -->
            <section class="student-list mt-2">
                <table class="table table-bordered" id="studentTable">
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
                            <tr data-nim="{{ $irs->nim }}">
                                <td>
                                    <input type="checkbox" class="form-check-input student-checkbox" data-nim="{{ $irs->nim }}">
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
        <!-- Add DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

<!-- Ensure SweetAlert is loaded -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#studentTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        searching: false,  // Disable the built-in search bar
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
            { orderable: false, targets: -1 }  // Disable sorting for the action column
        ]
    });

    // Select/Deselect All Checkbox
    $('#select-all').on('click', function() {
        var isChecked = this.checked;
        $('.student-checkbox').each(function() {
            this.checked = isChecked;
        });
    });

    // Handler for the Setujui IRS button
    $('#approve-btn').on('click', function() {
        var selectedNim = [];
        $('.student-checkbox:checked').each(function() {
            selectedNim.push($(this).data('nim'));
        });

        if (selectedNim.length > 0) {
            // Send the selected NIM to the server
            $.ajax({
                url: '/approve-irs',  // URL for the IRS approval API
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nim: selectedNim
                },
                success: function(response) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'IRS Berhasil Disetujui!',
                        text: `${selectedNim.length} mahasiswa telah disetujui.`,
                        confirmButtonText: 'OK'
                    });
                    // Optionally, reload the table if necessary
                    table.ajax.reload();  // If using AJAX data source, otherwise use table.clear().rows.add(newData).draw();
                },
                error: function(xhr, status, error) {
                    // Show error message with SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Tidak dapat menyetujui IRS. Coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        } else {
            // Show warning message with SweetAlert if no checkboxes are selected
            Swal.fire({
                icon: 'warning',
                title: 'Pilih IRS yang ingin disetujui',
                text: 'Pilih satu atau lebih IRS sebelum menyetujui.',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>

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