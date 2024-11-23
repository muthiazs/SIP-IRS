<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .btn-teal {
            background-color: #028391;
            color: white;
        }
        .form-label {
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
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
                <div>
                    <h1 class="fs-3 fw-bold">Selamat Datang {{ $akademik->nama }} 👋</h1>
                    <p class="text-muted">Semester Akademik Sekarang</p>
                </div>
                <div class="position-relative">
                    <button class="btn btn-teal rounded-circle p-2">
                        <span class="material-icons">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Form Tambah Ruang -->
            <div class="card shadow-sm">
                <h5 class="card-header bg-teal text-white text-center">Tambah Ruang Baru</h5>
                <div class="card-body">
                    <form action="{{ route('ruang.store') }}" method="POST">
                        @csrf <!-- Token CSRF Laravel untuk keamanan -->
                        <div class="mb-3">
                            <label for="gedung" class="form-label">Gedung</label>
                            <input type="text" class="form-control" id="gedung" name="gedung" required placeholder="Contoh: A">
                        </div>
                        <div class="mb-3">
                            <label for="lantai" class="form-label">Lantai</label>
                            <input type="number" class="form-control" id="lantai" name="lantai" required placeholder="Contoh: 2">
                        </div>
                        <div class="mb-3">
                            <label for="kode_ruang" class="form-label">Kode Ruang</label>
                            <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" required placeholder="Contoh: A201">
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required placeholder="Contoh: 50">
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi_id" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                @foreach($prodiList as $prodi)
                                    <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-teal w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
