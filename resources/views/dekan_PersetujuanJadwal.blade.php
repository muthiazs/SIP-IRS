<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Persetujuan Jadwal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
     <!-- DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>

    <style>
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
        <x-sidebar-dekan :dekan="$dekan"></x-sidebar-dekan>
        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat datang, {{ $dekan->username }} 👋</h1>
                    <p class="text-muted">Semester Akademik sekarang</p>
                </div>
            </div>
            <!-- Cards Section -->
            <!-- Jadwal Accordion -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($prodi as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $item->id_prodi }}" aria-expanded="false" aria-controls="flush-collapse-{{ $item->id_prodi }}">
                                {{ $item->nama }}
                            </button>
                        </h2>
                        <div id="flush-collapse-{{ $item->id_prodi }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <!-- Button for bulk approve -->
                                <button type="button" onclick="approveSelected({{ $item->id_prodi }})" class="btn btn-success mb-3">Setujui Semua yang Dipilih</button>
                                
                                @if(isset($jadwalPerProdi[$item->id_prodi]) && count($jadwalPerProdi[$item->id_prodi]) > 0)
                                    <table id="jadwalTable-{{ $item->id_prodi }}" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="selectAll-{{ $item->id_prodi }}" onclick="toggleSelectAll({{ $item->id_prodi }})"> Pilih Semua
                                                </th>
                                                <th>Kode MK</th>
                                                <th>Mata Kuliah</th>
                                                <th>Kelas</th>
                                                <th>SKS</th>
                                                <th>Ruang</th>
                                                <th>Nama Dosen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jadwalPerProdi[$item->id_prodi] as $index => $data)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="select-item-{{ $item->id_prodi }}" value="{{ $data->id_jadwal }}">
                                                    </td>
                                                    <td>{{ $data->kode_matkul }}</td>
                                                    <td>{{ $data->nama_matkul }}</td>
                                                    <td>{{ $data->kelas }}</td>
                                                    <td>{{ $data->sks }}</td>
                                                    <td>{{ $data->nama_ruang }}</td>
                                                    <td>{{ $data->nama_dosen }}</td>
                                                    <td>
                                                        <button type="button" onclick="confirmSubmit({{ $data->id_jadwal }})" class="btn btn-success btn-sm">Setujui</button>
                                                        <form id="setujui-form-{{ $data->id_jadwal }}" action="{{ route('jadwal.setujui') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="id_jadwal" value="{{ $data->id_jadwal }}">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>                                    
                                    </table>
                                @else
                                    <p>Belum ada jadwal yang tersedia untuk program studi ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>            
        </div>
    </div>

    <!-- Bootstrap JS and DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       $(document).ready(function() {
            // Initialize DataTable
            var table = $('#jadwalTable').DataTable({
                paging: true,   // Enable pagination
                searching: true, // Enable search box
                ordering: true,  // Enable sorting
                pageLength: 10,  // Number of rows per page
                lengthChange: false, // Disable the option to change number of rows per page
                responsive: true,
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
                }
            });

            // Reinitialize DataTable when an accordion item is expanded
            $('#accordionFlushExample').on('shown.bs.collapse', function () {
                table.columns.adjust().responsive.recalc(); // Recalculate the DataTable layout
            });
        });

       // Function to toggle select all checkboxes for a specific program studi
        function toggleSelectAll(prodiId) {
            let isChecked = document.getElementById('selectAll-' + prodiId).checked;
            let checkboxes = document.querySelectorAll('.select-item-' + prodiId);
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        }

        // Function to approve selected schedules for a specific program studi
        function approveSelected(prodiId) {
            let selectedItems = [];
            let checkboxes = document.querySelectorAll('.select-item-' + prodiId + ':checked');
            checkboxes.forEach(function(checkbox) {
                selectedItems.push(checkbox.value);
            });

            if (selectedItems.length > 0) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin menyetujui semua jadwal yang dipilih?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Setujui',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('jadwal.setujuiSemua') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_jadwals: selectedItems
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Semua jadwal berhasil disetujui.',
                                    'success'
                                );
                                $('#jadwalTable-' + prodiId).DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Gagal!',
                                    xhr.responseJSON?.error || 'Terjadi kesalahan, coba lagi.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire(
                    'Peringatan!',
                    'Pilih jadwal yang ingin disetujui terlebih dahulu.',
                    'warning'
                );
            }
        }


        // Function to show a confirmation alert before submitting the form
        function confirmSubmit(id_jadwal) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyetujui jadwal ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Trigger the form submission via AJAX
                    $.ajax({
                        url: "{{ route('jadwal.setujui') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_jadwal: id_jadwal
                        },
                        success: function(response) {
                            // If successful, show SweetAlert success message
                            Swal.fire(
                                'Berhasil!',
                                response.success,
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to update the table
                            });
                        },
                        error: function() {
                            // If error, show error message
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan, coba lagi.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>    
</body>
</html>
