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
            <!-- Search bar -->
            {{-- <div class="input-group" style="max-width: 250px;">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari Mata Kuliah" aria-label="Search" aria-describedby="button-addon2" style="max-height: 40px;">
                <button class="btn" style="background-color: #6878B1; color:#fff; max-height: 40px;" type="button" id="button-addon2">
                    <span class="material-icons">search</span>
                </button>
            </div> --}}
            <div class="card-body d-flex flex-column">
                <form id="jadwalForm" action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <!-- Mata Kuliah -->
                        <div class="mb-3">
                            <label for="namaMatakuliah" class="form-label">Mata Kuliah</label>
                            <select name="namaMatakuliah" id="namaMatakuliah" class="form-select" required>
                                <option value="" disabled selected>Pilih Mata Kuliah</option>
                                @foreach($namaMK as $matkul)
                                    <option value="{{ $matkul->nama_matkul }}">{{ $matkul->nama_matkul }}</option>
                                @endforeach
                            </select>
                            @error('namaMatakuliah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Kelas -->
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>

                        <!-- Hari -->
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select name="hari" id="hari" class="form-select" required>
                                <option value="" disabled selected>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>

                        <!-- Dosen -->
                        <div class="mb-3">
                            <label for="namaDosen" class="form-label">Dosen</label>
                            <select name="namaDosen" id="namaDosen" class="form-select" required>
                                <option value="" disabled selected>Pilih Dosen</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ruangan -->
                        <div class="mb-3">
                            <label for="namaRuang" class="form-label">Ruang</label>
                            <select name="namaRuang" id="namaRuang" class="form-select" required>
                                <option value="" disabled selected>Pilih Ruangan</option>
                                @foreach($ruangan as $r)
                                    <option value="{{ $r->nama_ruang }}">{{ $r->nama_ruang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jam Mulai -->
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                        </div>

                        <!-- Jam Selesai -->
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                        </div>

                        <!-- Kuota -->
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" required>
                        </div>

                        <button type="submit" class="btn btn-blue">Buat</button>
                    </form>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" id="confirmSchedule">Kembali</button>
</form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#jadwalForm').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: "{{ route('jadwal.store') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    // Menampilkan SweetAlert jika sukses
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Refresh halaman setelah sukses
                    });
                },
                error: function (xhr) {
                    // Menampilkan SweetAlert jika gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi'
                    });
                },
            });
        });
    });
</script>


</script>
    {{-- <script>
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
}); --}}

</script>

<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    

</body>
</html>