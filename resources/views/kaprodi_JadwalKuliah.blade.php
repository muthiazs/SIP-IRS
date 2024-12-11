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
                                <!-- Button on the right top -->
                                <div class="d-flex justify-content-between mb-3">
                        <a href="/kaprodi_CreateJadwal">
                            <button class="btn btn-blue">Tambah Jadwal</button>
                        </a>
                        <!-- Search Box -->
                        <input type="text" id="customSearchInput" class="form-control" placeholder="Cari Nama Matkul..." style="width: 200px;">
                    </div>
            <div class="card-body d-flex flex-column">
                {{-- <form action="{{ route('jad') }}" method="POST">
                    @csrf                         --}}
                    
                    <div class="card-body">
                         <!-- Button on the right top -->
                        <div class="d-flex justify-content-between mb-3">
                            <a href="/kaprodi_CreateJadwal">
                                <button class="btn btn-blue">Tambah Jadwal</button>
                            </a>
                            <!-- Search Box -->
                            <input type="text" id="customSearchInput" class="form-control" placeholder="Cari Nama Matkul..." style="width: 200px;">
                        </div>

                        <table class="table table-bordered mt-4" id="jadwalTable">
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
                                                    <input type="hidden" name="id" value="{{ $item->id_jadwal }}">
                                                    <!-- Mata Kuliah -->
                                                    <div class="mb-3">
                                                        <label for="namaMatakuliah" class="form-label">Mata Kuliah</label>
                                                        <select name="namaMatakuliah" id="namaMatakuliah" class="form-select" required>
                                                            @foreach($namaMK as $matkul)
                                                                <option value="{{ $matkul->nama_matkul }}" {{ $item->nama_matkul == $matkul->nama_matkul ? 'selected' : '' }}>
                                                                    {{ $matkul->nama_matkul }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Kelas -->
                                                    <div class="mb-3">
                                                        <label for="kelas" class="form-label">Kelas</label>
                                                        <select name="kelas" id="kelas" class="form-select" required>
                                                            <option value="A" {{ $item->kelas == 'A' ? 'selected' : '' }}>A</option>
                                                            <option value="B" {{ $item->kelas == 'B' ? 'selected' : '' }}>B</option>
                                                            <option value="C" {{ $item->kelas == 'C' ? 'selected' : '' }}>C</option>
                                                            <option value="D" {{ $item->kelas == 'D' ? 'selected' : '' }}>D</option>
                                                            <option value="E" {{ $item->kelas == 'E' ? 'selected' : '' }}>E</option>
                                                        </select>
                                                    </div>
                                                    <!-- Hari -->
                                                    <div class="mb-3">
                                                        <label for="hari" class="form-label">Hari</label>
                                                        <select name="hari" id="hari" class="form-select" required>
                                                            <option value="Senin" {{ $item->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                            <option value="Selasa" {{ $item->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                            <option value="Rabu" {{ $item->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                            <option value="Kamis" {{ $item->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                            <option value="Jumat" {{ $item->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                        </select>
                                                    </div>
                                                    <!-- Ruangan -->
                                                    <div class="mb-3">
                                                        <label for="namaRuang" class="form-label">Ruang</label>
                                                        <select name="namaRuang" id="namaRuang" class="form-select" required>
                                                            @foreach($ruangan as $r)
                                                                <option value="{{ $r->nama_ruang }}" {{ $item->nama_ruang == $r->nama_ruang ? 'selected' : '' }}>
                                                                    {{ $r->nama_ruang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Jam Mulai -->
                                                    <div class="mb-3">
                                                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $item->jam_mulai }}" required>
                                                    </div>
                                                    <!-- Jam Selesai -->
                                                    <div class="mb-3">
                                                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $item->jam_selesai }}" required>
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
                                                <form action="{{ route('delete.jadwal') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id_jadwal }}">
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


    <script>
        // Pastikan modal terbuka dan fokus pada elemen pertama saat modal ditampilkan
        $('#addScheduleModal').on('shown.bs.modal', function () {
            $('#kode_matkul').trigger('focus');  // Fokus pada elemen pertama
        });

   document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('addScheduleModal');
    
    // Pastikan modal ada
    if (modal) {
        // Event listener untuk modal ketika sudah muncul
        modal.addEventListener('shown.bs.modal', () => {
            // Tunggu sedikit sebelum mencari form
            setTimeout(() => {
                const jadwalForm = document.getElementById('jadwalForm');
                if (jadwalForm) {
                    jadwalForm.addEventListener('submit', async function (e) {
                        e.preventDefault(); // Mencegah reload halaman

                        const formData = new FormData(jadwalForm);
                        const submitButton = jadwalForm.querySelector('button[type="submit"]');

                        // Tampilkan loading pada tombol submit
                        submitButton.disabled = true;
                        submitButton.textContent = 'Menyimpan...';

                        try {
                            const response = await fetch('/jadwal-kuliah/store', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData,
                            });

                            // Validasi response
                            const result = await response.json();
                            if (!response.ok || !result.success) {
                                throw new Error(result.message || 'Gagal menyimpan jadwal kuliah');
                            }

                            // Tampilkan notifikasi sukses
                            alert(result.message || 'Jadwal berhasil disimpan!');

                            // Tutup modal
                            const modalInstance = bootstrap.Modal.getOrCreateInstance(modal);
                            modalInstance.hide();

                            // Reset form
                            jadwalForm.reset();

                            // Optional: Perbarui UI, misalnya reload data jadwal
                            console.log(result);
                        } catch (error) {
                            // Tampilkan pesan error
                            console.error(error);
                            alert('Terjadi kesalahan: ' + error.message);
                        } finally {
                            // Kembalikan tombol submit ke keadaan semula
                            submitButton.disabled = false;
                            submitButton.textContent = 'Buat';
                        }
                    });
                } else {
                    console.error('Form tidak ditemukan setelah modal dibuka!');
                }
            }, 500);  // Waktu tunggu 500ms (sesuaikan jika perlu)
        });
    }
});


$(document).ready(function () {
    // Ketika form disubmit
    $('#jadwalForm').on('submit', function (e) {
        e.preventDefault(); // Mencegah form agar tidak disubmit secara default

        // Mengambil data form
        var formData = $(this).serialize();  // Mengambil semua data form dalam format URL-encoded

        // Kirimkan data form ke server menggunakan AJAX
        $.ajax({
            url: $(this).attr('action'),  // URL action form (misalnya route('jadwal.store'))
            type: 'POST',  // Metode HTTP yang digunakan untuk mengirim data
            data: formData,  // Data form yang dikirimkan
            success: function (response) {
                // Tindakan jika permintaan berhasil
                // Misalnya, menutup modal dan menampilkan notifikasi sukses
                $('#addScheduleModal').modal('hide'); // Menutup modal setelah berhasil
                alert('Jadwal kuliah berhasil dibuat!');
                // Anda bisa menambahkan update data pada halaman tanpa reload
            },
            error: function (xhr, status, error) {
                // Menangani error jika request gagal
                alert('Terjadi kesalahan! Silakan coba lagi.');
            }
        });
    });
});



        // Cek konflik jadwal
        // public/js/schedule.js
        $(document).ready(function() {
            // Fungsi untuk memeriksa jadwal bentrok
            function isConflict(newSchedule) {
                const existingSchedules = getExistingSchedules(); // Ambil jadwal yang ada
                for (const schedule of existingSchedules) {
                    if (schedule.hari === newSchedule.hari && schedule.ruang === newSchedule.ruang) {
                        if ((newSchedule.jam_mulai < schedule.jam_selesai) && (newSchedule.jam_selesai > schedule.jam_mulai)) {
                            return true; // Jadwal bentrok
                        }
                    }
                }
                return false;
            }

            // Fungsi untuk mendapatkan jadwal yang sudah ada (ambil dari tabel)
            function getExistingSchedules() {
                const schedules = [];
                $('#scheduleTable tbody tr').each(function() {
                    const row = $(this);
                    schedules.push({
                        hari: row.find('.hari').text(),
                        ruang: row.find('.ruang').text(),
                        jam_mulai: row.find('.jam_mulai').text(),
                        jam_selesai: row.find('.jam_selesai').text(),
                    });
                });
                return schedules;
            }

            // Event handler untuk tombol 'Konfirmasi Jadwal'
            $('#confirmScheduleButton').click(function() {
                const newSchedule = {
                    matkul: $('#matkul').val(),
                    hari: $('#hari').val(),
                    ruang: $('#ruang').val(),
                    jam_mulai: $('#jam_mulai').val(),
                    jam_selesai: $('#jam_selesai').val(),
                };

                if (isConflict(newSchedule)) {
                    $('#errorMessage').show();
                } else {
                    addScheduleToTable(newSchedule);
                    $('#addScheduleModal').modal('hide');
                }
            });

            // Fungsi untuk menambah jadwal ke tabel
            function addScheduleToTable(schedule) {
                const table = $('#scheduleTable tbody');
                const newRow = `<tr>
                    <td>${table.find('tr').length + 1}</td>
                    <td>${schedule.matkul}</td>
                    <td>${schedule.hari}</td>
                    <td>${schedule.ruang}</td>
                    <td>${schedule.jam_mulai}</td>
                    <td>${schedule.jam_selesai}</td>
                    <td>
                        <button class="btn btn-danger btn-sm deleteScheduleButton">Hapus</button>
                    </td>
                </tr>`;
                table.append(newRow);

                // Tambahkan event listener untuk tombol hapus
                $('.deleteScheduleButton').click(function() {
                    $(this).closest('tr').remove();
                });
            }

        });

    </script>

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

    $(document).ready(function() {
    $('#jadwalForm').submit(function(e) {
        e.preventDefault(); // Mencegah form melakukan reload

        var formData = $(this).serialize(); // Mengambil data form

        $.ajax({
            url: '{{ route('jadwal.store') }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Jika berhasil, tambahkan row baru ke dalam tabel
                    var newRow = `
                        <tr>
                            <td>${$('#jadwalTable tbody tr').length + 1}</td>
                            <td>${response.kode_matkul}</td>
                            <td>${response.nama_matkul}</td>
                            <td>${response.kelas}</td>
                            <td>${response.nama_ruang}</td>
                            <td>${response.hari}</td>
                            <td>${response.jam_mulai}</td>
                            <td>${response.jam_selesai}</td>
                            <td>
                                <form action="{{ route('batalkanJadwal') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Batalkan Jadwal</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    $('#jadwalTable tbody').append(newRow); // Tambahkan row baru ke tabel

                    // Menutup modal
                    $('#addScheduleModal').modal('hide');

                    // Tampilkan notifikasi sukses
                    toastr.success('Jadwal berhasil ditambahkan!');
                } else {
                    toastr.error('Terjadi kesalahan saat menambahkan jadwal!');
                }
            },
            error: function() {
                toastr.error('Terjadi kesalahan saat mengirim data!');
            }
        });
    });
});

</script>

<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    

</body>
</html>