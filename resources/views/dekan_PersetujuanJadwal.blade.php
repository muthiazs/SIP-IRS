<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Persetujuan Jadwal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
                <div class="position-relative">
                    <button class="btn btn-teal rounded-circle p-2">
                        <span class="material-icons text-white">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4 d-flex justify-content-between">
                <span>Periode Persetujuan Ruang Kelas</span>
                <span> $data['semester']['period'] </span>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                        @php $filtered = $jadwal->filter(fn($data) => $data->id_prodi == $item->id_prodi); @endphp
                                        @if ($filtered->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada jadwal untuk program studi ini.</td>
                                            </tr>
                                        @else
                                            @foreach ($filtered as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->kode_matkul }}</td>
                                                    <td>{{ $data->nama_matkul }}</td>
                                                    <td>{{ $data->kelas }}</td>
                                                    <td>{{ $data->sks }}</td>
                                                    <td>{{ $data->nama_ruang }}</td>
                                                    <td>{{ $data->nama_dosen }}</td>
                                                    <td>
                                                        <form action="{{ route('jadwal.setujui') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id_jadwal" value="{{ $data->id_jadwal }}">
                                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                        </form>
                                                        <!-- <button class="btn btn-danger btn-sm">Tolak</button> -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
