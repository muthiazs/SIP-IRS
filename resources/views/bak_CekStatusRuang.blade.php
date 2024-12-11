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
        .main-content {
            overflow-x: hidden;
        }
        .text-blue {
            color: #456DDB;
        }
        .card-body {
            background-color: #FFF2E5;
            overflow-x: hidden;
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
        /* DataTables Styling */
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
            overflow-x: hidden;
            max-width: 100%;
            margin: 0;
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
                <h3 class="text-teal">Dashboard</h3>
            </div>

            <!-- Card: Cek Status Pembagian Ruang -->
            <div class="card shadow-sm w-100 mx-0">
                <h5 class="card-header bg-teal text-white text-center">Cek Status Pembagian Ruang Kelas</h5>
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

                    <!-- Tabel Data -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="cekTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th> <!-- Checkbox untuk pilih semua -->
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
                                    <td><input type="checkbox" class="ruang-checkbox" data-nama="{{ $data->nama }}"></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kapasitas }}</td>
                                    <td>{{ $data->nama_prodi }}</td>
                                    <td>
                                        <form action="{{ route('cancel.ruang') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="nama_ruang" value="{{ $data->nama }}">
                                            <button type="submit" class="btn btn-primary mb-2">Batalkan</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button id="cancel-selected" class="btn btn-primary btn-sm" style="padding: 5px 15px; font-size: 14px; border-radius: 8px;">
                            Batalkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Combined Scripts -->
    <script>
        $(document).ready(function() {
            // DataTables Initialization
            const table = $('#cekTable').DataTable({
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

            // Dropdown filter logic
            $('#selectProdi').on('change', function() {
                const selectedProdi = $(this).val().trim();
                if (selectedProdi) {
                    // Jika ada prodi yang dipilih, filter berdasarkan kolom program studi
                    table.column(4).search(selectedProdi).draw(); // Kolom program studi ada di indeks 4
                } else {
                    // Jika tidak ada prodi yang dipilih, tampilkan semua data
                    table.column(4).search('').draw();
                }
            });

            // Form submission handler
            $('form').submit(function(e) {
                e.preventDefault();
                
                const rowProdi = $(this).closest('tr').find('td:eq(3)').text().trim();
                const ruangName = $(this).closest('tr').find('td:eq(1)').text().trim();

                Swal.fire({
                    title: 'Konfirmasi Pembatalan',
                    text: `Anda yakin ingin membatalkan alokasi ruang ${ruangName} untuk Prodi ${rowProdi}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#028391',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
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
    <script>
         $(document).ready(function () {
            const table = $('#cekTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json',
                },
            });

            // Pilih/Deselect Semua Checkbox
            $('#select-all').on('click', function () {
                const isChecked = this.checked;
                $('.ruang-checkbox').each(function () {
                    this.checked = isChecked;
                });
            });

            // Tombol Batalkan yang Dipilih
            $('#cancel-selected').on('click', function () {
                const selectedRuang = [];
                $('.ruang-checkbox:checked').each(function () {
                    selectedRuang.push($(this).data('nama'));
                });

                if (selectedRuang.length > 0) {
                    Swal.fire({
                        title: 'Konfirmasi Pembatalan',
                        text: `Anda yakin ingin membatalkan alokasi ${selectedRuang.length} ruangan?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, batalkan!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim data ke server via AJAX
                            $.ajax({
                                url: '{{ route("cancel.selected.ruang") }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    nama_ruang: selectedRuang,
                                },
                                success: function (response) {
                                    Swal.fire({
                                        title: response.title,
                                        text: response.text,
                                        icon: response.icon,
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        location.reload(); // Reload halaman untuk memperbarui tabel
                                    });
                                },
                                error: function () {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat membatalkan ruangan. Coba lagi.',
                                        confirmButtonText: 'OK',
                                    });
                                },
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada ruangan yang dipilih',
                        text: 'Silakan pilih satu atau lebih ruangan untuk dibatalkan.',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    </script>
</body>
</html>