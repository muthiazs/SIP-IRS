<!DOCTYPE html>
<html lang="en">
<head>
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
        </div>

        <!-- Progress Cards -->
        <div class="card shadow-sm">
            <h5 class="card-header bg-teal text-white text-center">Pembagian Ruang Kelas</h5>
            <div class="card-body d-flex flex-column">
                <form action="{{ route('ruang.store') }}" method="POST">
                    @csrf
                    <!-- Dropdown Prodi -->
                    <div class="mb-3">
                        <label class="fw-bold">Mata Kuliah</label>
                        <select name="kode_matkul" class="form-select" id="selectMatkul" required>
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($namaMK as $matkul)
                                <option value="{{ $matkul->kode_matkul }}">{{ $matkul->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Dropdown Gedung -->
                    <div class="mb-3">
                        <label class="fw-bold">Ruang</label>
                        <select name="gedung" class="form-select" id="selectGedung" required>
                            <option value="">Pilih Ruang</option>
                            @foreach($ruangan as $r)
                                <option value="{{ $r->id_ruang }}">{{ $r->nama }} (Kapasitas: {{ $r->kapasitas }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Gedung -->
                    <div class="mb-3">
                        <label class="fw-bold">Jam Mulai</label>
                        <select name="gedung" class="form-select" id="selectGedung" required>
                            <option value="">Pilih Jam</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>

                    <!-- Tabel -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</t>
                                <th>Jumat</th>
                            </tr>
                        </thead>
                    </table>
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

</body>
</html>