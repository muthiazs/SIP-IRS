<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SIP-IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
        <div>
            <!-- Sidebar -->
            @include ('sidebar')
        </div>
        

        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                    <h1 class="fs-3 fw-bold">Selamat datang, {{  $mahasiswa->username }} 👋</h1>
                    <p class="text-muted">Semester Akademik Sekarang </p>
                </div>
                <div class="position-relative">
                    <button class="btn btn-primary rounded-circle p-2">
                        <span class="material-icons">notifications</span>
                    </button>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">Notifikasi baru</span>
                    </span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">Periode Pengisian IRS</span>
                    <!-- <span class="fw-medium"> $data['semester']['period'] </span> -->
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">Semester Studi</h6>
                        <!-- ini aku isi sembarangan duluu aku mau coba bikin side bar nya ga berubah klo di-scroll -->
                        <h2 class="mb-0"> 10 </h2>
                        <!-- <h2 class="mb-0"> $data['stats']['semester']</h2> -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">IPK</h6>
                        <h2 class="mb-0"> 10 </h2>
                        <!-- <h2 class="mb-0"> $data['stats']['ipk'] </h2> -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h6 class="text-muted mb-2">SKSk</h6>
                        <h2 class="mb-0"> 10 </h2>
                        <!-- <h2 class="mb-0"> $data['stats']['sksk'] </h2> -->
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
                        <a href="#" class="btn btn-outline-primary">Lihat Kalender</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stats-card">
                        <h5 class="mb-3">Status IRS</h5>
                        @if(isset($data['status']) && $data['status']['irs'] === 'ditolak')
                            <div class="alert alert-danger mb-0">
                                Isian Rencana Studi Ditolak
                                <a href="/pengisianIRS" class="btn btn-danger mt-2">Lihat Detail</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Registration Status -->
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>