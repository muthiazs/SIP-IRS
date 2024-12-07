<!DOCTYPE html>
<html lang="en">
<head>
    @php
    use Illuminate\Support\Facades\Session;
@endphp

    <meta charset="UTF-8">
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
            <div>
                <h1 class="fs-3 fw-bold">Selamat Datang {{ $kaprodi->username }} 👋</h1>
                <p class="text-muted">Semester kaprodi Sekarang</p>
            </div>
            <div class="position-relative">
                <button class="btn btn-teal rounded-circle p-2">
                    <span class="material-icons">notifications</span>
                </button>
                <span class="notification-badge"></span>
            </div>
        </div>

        <!-- Progress Cards -->
        <div class="card shadow-sm">
            <h5 class="card-header bg-teal text-white text-center">Pembagian Jadwal Kuliah</h5>
            <div class="card-body d-flex flex-column">
                <form action="{{ route('ruang.store') }}" method="POST">
                    @csrf                        
                    <div class="card-body">
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
                                    <td>{{ $item->namaruang }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam_mulai }}</td>
                                    <td>{{ $item->jam_selesai }}</td>
                                    <td>
                                        {{-- <form action="{{ route('jadwal.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Tambah Jadwal</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-teal text-white">
                                    <h5 class="modal-title" id="addScheduleModalLabel">Tambah Jadwal Kuliah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jadwal.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="kode_matkul" class="form-label">Mata Kuliah</label>
                                            <select name="kode_matkul" id="kode_matkul" class="form-select" required>
                                                <option value="">Pilih Mata Kuliah</option>
                                                @foreach($namaMK as $matkul)
                                                    <option value="{{ $matkul->kode_matkul }}">{{ $matkul->nama_matkul }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hari" class="form-label">Hari</label>
                                            <select name="hari" id="hari" class="form-select" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ruang" class="form-label">Ruang</label>
                                            <select name="ruang" id="ruang" class="form-select" required>
                                                <option value="">Pilih Ruang</option>
                                                <!-- Ruang akan diisi berdasarkan prodi -->
                                                <option value="E101">E101</option>
                                                <option value="E102">E102</option>
                                                <option value="E103">E103</option>
                                                <option value="E201">E201</option>
                                                <option value="E202">E202</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                                        </div>
                                        <button type="submit" class="btn btn-teal">Buat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-secondary" id="saveDraft">Simpan Draf</button>
                    <button class="btn btn-primary" id="confirmSchedule">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Dropdown Logic
<script>
$(document).ready(function() {
    $('#selectGedung').change(function() {
        const gedung = $(this).val();
        filterTabelByGedung(gedung);
    });
});

function filterTabelByGedung(gedung) {
    $('#tabelRuang tr').each(function() {
        if ($(this).find('td').length) {
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

Toastr -->
    <!-- <script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "escapeHtml": true
        }

        @if(Session::has('toast_success'))
            toastr.success('Ruangan berhasil dialokasikan');
        @endif

        @if(Session::has('toast_error'))
            toastr.error("{!! Session::get('toast_error') !!}"); 
        @endif
    });
    </script> --> 

    <script>
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

            // Event handler untuk tombol 'Simpan Draft'
            $('#saveDraftButton').click(function() {
                const newSchedule = {
                    matkul: $('#matkul').val(),
                    hari: $('#hari').val(),
                    ruang: $('#ruang').val(),
                    jam_mulai: $('#jam_mulai').val(),
                    jam_selesai: $('#jam_selesai').val(),
                };
                
                saveDraft(newSchedule);
                $('#addScheduleModal').modal('hide');
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

            // Fungsi untuk menyimpan draft
            function saveDraft(schedule) {
                $.ajax({
                    url: '/save-draft',
                    method: 'POST',
                    data: {
                        matkul: schedule.matkul,
                        hari: schedule.hari,
                        ruang: schedule.ruang,
                        jam_mulai: schedule.jam_mulai,
                        jam_selesai: schedule.jam_selesai,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Draft berhasil disimpan');
                    }
                });
            }
        });

    </script>

</body>
</html>