<!DOCTYPE html>
<html lang="en">
<head>
    @php
    use Illuminate\Support\Facades\Session;
@endphp
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIP-IRS Buat Jadwal Kuliah</title>
<!-- jQuery HARUS PERTAMA -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Kemudian Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<!-- CSS dan JS dari public -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
{{-- <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script> --}}
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
        <!-- Progress Cards -->
        <div class="card shadow-sm">
            <h5 class="card-header bg-teal text-white text-center">Pembagian Jadwal Kuliah</h5>
                    <div class="card-body">
                         <!-- Button on the right top -->
                        <div class="d-flex justify-content-end mb-3">
                            <a href="/kaprodi_CreateJadwal" class="btn btn-success btn-sm">
                                <i class="material-icons">add</i> Tambah Jadwal Kuliah Baru
                            </a>
                        </div>
                        <!-- Search Box -->
                        <div class="mb-3">
                            <input type="text" id="customSearchInput" class="form-control" placeholder="Cari Nama Matkul..." style="width: 200px;">
                        </div>
                        <table class="table table-bordered" id="jadwalTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Matkul</th>
                                    <th>Nama Matkul</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->kode_matkul }}</td>
                                    <td>{{ $item->nama_matkul }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->nama_ruang }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam_mulai }}</td>
                                    <td>{{ $item->jam_selesai }}</td>
                                    <td>
                                        <!-- Update Button -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item->id_jadwal }}">
                                            <i class="material-icons">edit</i> Update
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_jadwal }}">
                                            <i class="material-icons">delete</i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal{{ $item->id_jadwal }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-teal text-white">
                                                <h5 class="modal-title">Update Jadwal {{ $item->id_jadwal }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div> 
                                            <div class="modal-body">
                                                <form action="{{ route('update.jadwal') }}" method="POST">
                                                    @csrf
                                                    <!-- Hidden input for jadwal ID -->
                                                    <input type="hidden" name="id_jadwal" value="{{ $item->id_jadwal }}">
                                                    <!-- Mata Kuliah -->
                                                    <div class="mb-3">
                                                        <label for="nama_matkul_{{ $item->id_jadwal }}" class="form-label">Mata Kuliah</label>
                                                        <select name="nama_matkul" id="nama_matkul_{{ $item->id_jadwal }}" class="form-select" disabled>
                                                            @foreach($namaMK as $matkul)
                                                                <option value="{{ $matkul->nama_matkul }}" 
                                                                    {{ $item->nama_matkul == $matkul->nama_matkul ? 'selected' : '' }}>
                                                                    {{ $matkul->nama_matkul }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Kelas -->
                                                    <div class="mb-3">
                                                        <label for="kelas_{{ $item->id_jadwal }}" class="form-label">Kelas</label>
                                                        <select name="kelas" id="kelas_{{ $item->id_jadwal }}" class="form-select" required>
                                                            <option value="A" {{ $item->kelas == 'A' ? 'selected' : '' }}>A</option>
                                                            <option value="B" {{ $item->kelas == 'B' ? 'selected' : '' }}>B</option>
                                                            <option value="C" {{ $item->kelas == 'C' ? 'selected' : '' }}>C</option>
                                                            <option value="D" {{ $item->kelas == 'D' ? 'selected' : '' }}>D</option>
                                                            <option value="E" {{ $item->kelas == 'E' ? 'selected' : '' }}>E</option>
                                                        </select>
                                                    </div>

                                                    <!-- Hari -->
                                                    <div class="mb-3">
                                                        <label for="hari_{{ $item->id_jadwal }}" class="form-label">Hari</label>
                                                        <select name="hari" id="hari_{{ $item->id_jadwal }}" class="form-select" required>
                                                            <option value="Senin" {{ $item->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                            <option value="Selasa" {{ $item->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                            <option value="Rabu" {{ $item->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                            <option value="Kamis" {{ $item->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                            <option value="Jumat" {{ $item->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                        </select>
                                                    </div>

                                                   <!-- Ruangan -->
                                                    <div class="mb-3">
                                                        <label for="id_ruang_{{ $item->id_jadwal }}" class="form-label">Ruang</label>
                                                        <select name="nama_ruang" id="id_ruang_{{ $item->id_jadwal }}" class="form-select" required>
                                                            @foreach($ruangan as $r)
                                                                <option value="{{ $r->nama_ruang }}" 
                                                                    {{ $item->nama_ruang == $r->nama_ruang ? 'selected' : '' }}>
                                                                    {{ $r->nama_ruang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Jam Mulai -->
                                                    <div class="mb-3">
                                                        <label for="jam_mulai_{{ $item->id_jadwal }}" class="form-label">Jam Mulai</label>
                                                        <input type="time" class="form-control" id="jam_mulai_{{ $item->id_jadwal }}" name="jam_mulai" value="{{ $item->jam_mulai }}" required>
                                                    </div>

                                                    <!-- Jam Selesai -->
                                                    <div class="mb-3">
                                                        <label for="jam_selesai_{{ $item->id_jadwal }}" class="form-label">Jam Selesai</label>
                                                        <input type="time" class="form-control" id="jam_selesai_{{ $item->id_jadwal }}" name="jam_selesai" value="{{ $item->jam_selesai }}" required>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id_jadwal }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Jadwal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('batalkan.jadwal') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_jadwal" value="{{ $item->id_jadwal }}">
                                                    <p>Apakah Anda yakin ingin menghapus jadwal mata kuliah ini?</p>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#jadwalTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
                { orderable: false, targets: -1 }  // Disable sorting for action column
            ],
            // Customizing dom to hide default search box
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            initComplete: function() {
                // Connect custom search box with DataTables
                $('#customSearchInput').on('keyup', function() {
                    table.search(this.value).draw();
                });

                // Reset search on button click
                $('#resetSearchButton').on('click', function() {
                    table.search('').draw();
                });
            }
        });
    });

    //update
    $('form[action="{{ route('update.jadwal') }}"]').submit(function(e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Konfirmasi Update',
            text: 'Apakah Anda yakin ingin mengupdate jadwal ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#028391',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("Form submitted with updated values."); // Debug
                form.submit();
            } else {
                console.log("Form not submitted."); // Debug
            }
        });
    });


    // Delete form handler for Jadwal
    $('form[action="{{ route('batalkan.jadwal') }}"]').submit(function(e) {
        e.preventDefault();
        const form = this;
        const idJadwal = $('input[name="id_jadwal"]', form).val(); // Get id_jadwal value from the hidden input field

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus jadwal dengan ID ${idJadwal}?`,
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
    @if (session('sweetAlert'))
        Swal.fire({
            title: "{{ session('sweetAlert')['title'] }}",
            text: "{{ session('sweetAlert')['text'] }}",
            icon: "{{ session('sweetAlert')['icon'] }}",
            confirmButtonColor: '#028391',
        });
    @endif
</script>

<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    

</body>
</html>