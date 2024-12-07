<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
    <!-- untuk manggil komponen sidebar -->
    <x-sidebar-mahasiswa :mahasiswa="$mahasiswa" :masaIRS="$masaIRS"></x-sidebar-mahasiswa>
        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>
        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center ">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat datang, {{  $mahasiswa->username }} 👋</h1>
                    <p class="text-muted"> {{ $mahasiswa->nama_periode }} </p>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="alert alert-success" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">Periode Pengisian IRS: {{$fetchPeriodeISIIRS->tanggal_mulai}} - {{$fetchPeriodeISIIRS->tanggal_selesai}}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">Semester Studi</h6>
                        <!-- ini aku isi sembarangan duluu aku mau coba bikin side bar nya ga berubah klo di-scroll -->
                        <h2 class="mb-0"> {{ $mahasiswa->semester }} </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">IPK</h6>
                        <h2 class="mb-0">{{ $mahasiswa->IPk }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">SKSk</h6>
                        <h2 class="mb-0"> {{ $mahasiswa->SKSk }} </h2>
                    </div>
                </div>
            </div>

            <!-- Status Cards -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="d-flex align-items-center mb-3">
                            <span class="material-icons text-primary me-2">calendar_today</span>
                            <h5 class="mb-0">Kalender Akademik</h5>
                        </div>
                        <a href="{{ route('kalender_akademik') }}" class="btn btn-outline-primary">Lihat Kalender</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stats-card">
                        <h5 class="mb-3">Status IRS</h5>
                        <p class="fs-6 fw-semibold mb-2">Periode pengisian IRS dibuka dari {{ $fetchPeriodeISIIRS->tanggal_mulai }} - {{ $fetchPeriodeISIIRS->tanggal_selesai }} </p>
                            <div class="button-group-right">
                            @if ($masaIRS === 'isiIRS')
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('mhs_newIRS') }}'">Buat IRS</button>
                            @elseif ($masaIRS === 'gantiIRS' || $masaIRS === 'batalIRS')
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('mhs_draftIRS') }}'">Edit IRS</button>
                            @else
                                <button class="btn btn-secondary" onclick="window.location.href='{{ route('mhs_habisPeriodeIRS') }}'">Periode IRS Habis</button>
                            @endif
                                                    </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Registration Status -->
            <div class="stats-card mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="material-icons text-primary me-2">how_to_reg</span>
                        <h5 class="mb-0">Registrasi</h5>
                    </div>
                    @if(isset($data['status']['registrasi']))
                        <span class="badge bg-success">Sudah Registrasi</span>
                    @else
                        <span class="badge bg-danger">Belum Registrasi</span>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>