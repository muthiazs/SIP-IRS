<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- jQuery HARUS PERTAMA -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        .table thead th {
            background-color: #FED488;
            color: black;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 12px;
        }
        .table tbody td {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 12px;
            color: black;
        }
        .d-flex.gap-3 {
            gap: 20px;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            table-layout: fixed;
            width: 100%;
            padding: 10px;
        }
        .table th, .table td {
            word-wrap: break-word;
            text-align: center;
        }
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
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }
        .badge {
            font-size: 11px;
            padding: 5px 10px;
        }
        button:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }
        .text-danger {
            font-size: 11px;
            margin-top: 5px;
        }
        .btn-sm .material-icons {
            vertical-align: middle;
            margin-top: -2px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <x-sidebar-kaprodi :kaprodi="$kaprodi"></x-sidebar-kaprodi>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
            </div>

            <!-- Card -->
            <div class="card shadow-sm">
                <h5 class="card-header bg-teal text-white text-center">Tinjau dan Hapus Matakuliah</h5>
                <div class="card-body d-flex flex-column">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cekTable">
                            <thead>
                                <tr>
                                    <th>Kode Matkul</th>
                                    <th>Nama Matkul</th>
                                    <th>SKS</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mataKuliah as $matakuliah)
                                <tr>
                                    <td>{{ $matakuliah->kode_matkul }}</td>
                                    <td>{{ $matakuliah->nama_matkul }}</td>
                                    <td>{{ $matakuliah->sks }}</td>
                                    <td>{{ $matakuliah->semester }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $matakuliah->id_matkul }}">
                                            <i class="material-icons">edit</i> Update
                                        </button>
                                        <button class="btn {{ $matakuliah->hasConstraint ? 'btn-secondary' : 'btn-danger' }} btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $matakuliah->id_matkul }}"
                                                {{ $matakuliah->hasConstraint ? 'disabled' : '' }}
                                                data-bs-tooltip="tooltip"
                                                title="{{ $matakuliah->hasConstraint ? 'Matakuliah tidak dapat dihapus karena sedang digunakan' : 'Hapus matakuliah' }}">
                                            <i class="material-icons">delete</i> Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal{{ $matakuliah->id_matkul }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-teal text-white">
                                                <h5 class="modal-title">Update Matakuliah {{ $matakuliah->nama_matkul }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update.matkul') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_matkul" value="{{ $matakuliah->id_matkul }}">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode Matkul</label>
                                                        <input type="text" class="form-control" id="kode" name="kode_matkul" value="{{ $matakuliah->kode_matkul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Matkul</label>
                                                        <input type="text" class="form-control" id="nama" name="nama_matkul" value="{{ $matakuliah->nama_matkul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sks" class="form-label">SKS</label>
                                                        <input type="number" class="form-control" id="sks" name="sks" value="{{ $matakuliah->sks }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <input type="number" class="form-control" id="semester" name="semester" value="{{ $matakuliah->semester }}" required>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary" style="background-color: #028391;">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                @if(!$matakuliah->hasConstraint)
                                <div class="modal fade" id="deleteModal{{ $matakuliah->id_matkul }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Matakuliah {{ $matakuliah->nama_matkul }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('delete.matkul') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_matkul" value="{{ $matakuliah->id_matkul }}">
                                                    <p class="mb-3">Apakah Anda yakin ingin menghapus matakuliah {{ $matakuliah->nama_matkul }}?</p>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
    // Initialize DataTables
    const table = $('#cekTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json',
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data matakuliah tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data matakuliah yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });

    // Kode Matkul dropdown handler
    $('.dropdown-item-kode-matkul').on('click', function() {
        const kodeMatkul = $(this).text();
        $('#dropdownMenuKodeMatkul').text('Kode Matkul: ' + kodeMatkul);
        table.search(kodeMatkul).draw();
    });

    // Update form handler
    $('form[action="{{ route('update.matkul') }}"]').submit(function(e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Konfirmasi Update',
            text: 'Apakah Anda yakin ingin mengupdate data matakuliah?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#028391',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Delete form handler
    $('form[action="{{ route('delete.matkul') }}"]').submit(function(e) {
        e.preventDefault();
        const form = this;
        const kodeMatakuliah = $('#dropdownMenuKodeMatkul').text().trim().replace('Kode Matkul: ', '');

        if (kodeMatakuliah === 'Pilih Kode Matkul') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Silahkan pilih Kode Matakuliah terlebih dahulu!',
                confirmButtonColor: '#028391'
            });
            return false;
        }

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus matakuliah dengan kode ${kodeMatakuliah}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#028391',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

function filterTabelByKodeMatkul(kodeMatkul) {
    $('tbody tr').each(function() {
        const kode = $(this).find('td:first').text().trim();
        if (kode.toLowerCase().startsWith(kodeMatkul.toLowerCase())) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Success/Error message handler
@if(session('sweetAlert'))
            document.addEventListener('DOMContentLoaded', function() {
                const alert = @json(session('sweetAlert'));
                Swal.fire({
                    title: alert.title,
                    text: alert.text,
                    icon: alert.icon,
                    confirmButtonColor: '#028391',
                    confirmButtonText: 'OK'
                });
            });
        @endif
    </script>
</body>
</html>