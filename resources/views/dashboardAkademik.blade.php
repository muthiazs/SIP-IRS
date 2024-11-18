<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Buat ubah font jadi poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>

<body class="bg-light">
    <div class="d-flex">
        <x-sidebar-akademik :akademik="$akademik"></x-sidebar-akademik>

        <!-- Wave decoration -->
        <div class="wave-decoration">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                    style="stroke: none; fill: #fff;">
                </path>
            </svg>
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
                        <span class="material-icons text-white">notifications</span>
                    </button>
                    <span class="notification-badge"></span>
                </div>
            </div>

            <!-- Period Banner -->
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white">Periode Pemeagian Ruang Kelas</span>
                    <span class="text-white fw-bold">$data['semester']['period']</span>
                </div>
            </div>

            <!-- Progress Cards -->
            <div class="row g-4 mb-4">
                <!-- Progress Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="fs-5 fw-semibold mb-4">Penyusunan Pembagian Ruang Kelas</h3>
                            <div class="d-flex justify-content-between text-center">
                            <div>
                                    <div class="fs-4 fw-bold text-danger">
                                        1 / 1
                                    </div>
                                    <div class="small text-muted">Belum Mengusulkan</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-teal">
                                        1 / 1
                                    </div>
                                    <div class="small text-muted">Telah Dikonfirmasi</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-blue">
                                        1 / 1
                                    </div>
                                    <div class="small text-muted">Belum Dikonfirmasi</div>
                                </div>
                            </div>
                                <!-- <div>
                                    <div class="fs-4 fw-bold text-danger">
                                        $data['progress']['belum_usul']['count'] /
                                        $data['progress']['belum_usul']['total']
                                    </div>
                                    <div class="small text-muted">Belum Mengusulkan</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-teal">
                                        $data['progress']['dikonfirmasi']['count'] /
                                        $data['progress']['dikonfirmasi']['total']
                                    </div>
                                    <div class="small text-muted">Telah Dikonfirmasi</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-blue">
                                        $data['progress']['belum_dikonfirmasi']['count'] /
                                        $data['progress']['belum_dikonfirmasi']['total']
                                    </div>
                                    <div class="small text-muted">Belum Dikonfirmasi</div>
                                </div>
                            </div> -->
                            <button class="btn btn-blue">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="fs-5 fw-semibold">Status Pengusulan Pembagian Ruang Kelas</h3>
                                <span class="fs-4 text-danger">⚠️</span>
                            </div>
                            <p class="fs-3 fw-bold">
                                $data['status']['bagiruang']
                            </p>
                            <button class="btn btn-blue">
                                Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="material-icons text-teal me-2">calendar_today</span>
                            <h3 class="fs-5 fw-semibold mb-0">Kalender Akademik</h3>
                        </div>
                        <button class="btn text-teal btn-teal rounded-circle p-2">
                            <span class="material-icons">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>





