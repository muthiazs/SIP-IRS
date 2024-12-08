<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- jQuery HARUS PERTAMA -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
            font-family: 'Poppins';
            text-align: center;
            font-size: 12px;
        }
        .table tbody td {
            color: black;
            font-family: 'Poppins';
            text-align: center;
            font-size: 12px;
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
                <h5 class="card-header bg-teal text-white text-center">Pembagian Ruang Kelas</h5>
                <div class="card-body d-flex flex-column">
                    <!-- Dropdown Prodi -->
                    <div class="mb-3">
                        <label class="fw-bold">Program Studi</label>
                        <select name="prodi" class="form-select" id="selectProdi" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Bioteknologi">Bioteknologi</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Statistika">Statistika</option>
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <input type="text" id="searchNamaRuang" class="form-control" placeholder="Cari Nama Ruang..." style="max-width: 250px; max-height: 40px;">
                        <button class="btn ms-2" style="background-color: #6878B1; color: #fff; max-width: 250px; max-height: 40px;" type="button" id="button-addon2">
                            <span class="material-icons">search</span>
                        </button>
                    </div>
                    

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-bordered mt-4" id="ruangTable">
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
                                        <form action="{{ route('ruang.store') }}" method="POST" class="room-form">
                                            @csrf
                                            <input type="hidden" name="prodi" class="prodi-input">
                                            <input type="hidden" name="gedung" class="gedung-input">
                                            <input type="hidden" name="nama_ruang" value="{{ $data->nama }}">
                                            <button type="submit" class="btn btn-primary">Tambah Ruang</button>
                                        </form>
                                    </td>
                                </tr>
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
            // Initialize DataTable
            const table = $('#ruangTable').DataTable({
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
                    { orderable: false, targets: -1 }
                ],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });

            // Handle dropdown changes
            $('#selectProdi').change(function() {
                const prodi = $(this).val();
                
                // Update all hidden inputs with the selected "prodi"
                $('.prodi-input').val(prodi);

            });

            // Handle form submission
            $('.room-form').submit(function(e) {
                e.preventDefault();

                const prodi = $('#selectProdi').val();
                const namaRuang = $(this).find('input[name="nama_ruang"]').val();

                if (!prodi) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Silahkan pilih Program Studi terlebih dahulu!',
                        confirmButtonColor: '#028391'
                    });
                    return false;
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    text: `Anda akan menambahkan ruang ${namaRuang} untuk Prodi ${prodi}.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#028391',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Handle search functionality
            $('#button-addon2').on('click', function() {
                const searchValue = $('#searchNamaRuang').val();
                table.search(searchValue).draw();
            });

            $('#searchNamaRuang').on('keyup', function(e) {
                if (e.key === 'Enter') {
                    const searchValue = $(this).val();
                    table.search(searchValue).draw();
                }
            });
        });

        // SweetAlert for success/error messages
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