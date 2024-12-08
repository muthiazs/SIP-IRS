<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Buat IRS Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
    <!-- untuk manggil komponen sidebar -->
    <x-sidebar-mahasiswa :mahasiswa="$mahasiswa"></x-sidebar-mahasiswa>
        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                    <h1 class="fs-3 fw-bold">Pengisian IRS Mahasiswa 👩🏻‍💻 </h1>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                </div>
            </div>

            <!-- Alert Banner -->
            <div class="alert alert-success" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">Periode Pengisian IRS Dimulai sampai tanggal {{ $fetchPeriodeISIIRS->tanggal_mulai }} - {{ $fetchPeriodeISIIRS->tanggal_selesai }}</span>
                    <!-- <span class="fw-medium"> $data['semester']['period'] </span> -->
                </div>
            </div>

            <!--  Card -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fs-5 fw-semibold">Periode pengisian IRS</h3>
                            <span class="fs-4 text-danger">🗓️</span>
                        </div>
                        <p class="fs-6 fw-semibold mb-2">Periode pengisian irs dibuka dari {{ $fetchPeriodeISIIRS->tanggal_mulai }} - {{ $fetchPeriodeISIIRS->tanggal_selesai }} </p>
                        <div class="button-group-right">
                            <button type="button" class="btn {{ $existingIRS ? 'btn-secondary' : 'btn-primary' }}" 
                                    onclick="window.location.href='{{ route('mhs_pengisianIRS') }}'"
                                    {{ $existingIRS ? 'disabled' : '' }}>
                                Buat IRS
                            </button>
                        </div>
                    </div>
                </div>
            </div>

           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>