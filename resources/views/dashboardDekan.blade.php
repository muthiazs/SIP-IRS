<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard Dekan</title>
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
    <x-sidebar-dekan :dekan="$dekan"></x-sidebar-dekan>
        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fs-3 fw-bold">Selamat datang, {{ $dekan->dosen_nama }} 👋</h1>
                    <p class="text-muted"> Semester Akademik </p>
                </div>
            </div>

            <!-- Period Banner Setuju Ruangan Jadwal -->
            <div class="alert alert-success" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-medium">
                        Masa Setuju Ruangan Jadwal: 
                        @if($masaSetujuRuanganJadwal)
                            {{ $masaSetujuRuanganJadwal->nama_kegiatan }} 
                            ({{ $masaSetujuRuanganJadwal->tanggal_mulai }} - {{ $masaSetujuRuanganJadwal->tanggal_selesai }})
                        @else
                            Tidak ada periode setuju ruangan jadwal yang aktif
                        @endif
                    </span>
                </div>
            </div>


            <!-- Progress Cards Jadwal Kuliah-->
            <div class="row g-4 mb-4">
                <!-- Progress Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="fs-5 fw-semibold mb-4">Progress persetujuan Jadwal Kuliah</h3>
                            <div class="d-flex justify-content-between text-center">
                                <div class="text-center">
                                    <div class="fs-4 fw-bold text-danger">
                                        1 / 1 
                                    </div>
                                    <div class="small text-muted">Belum<br>Mengusulkan</div>
                                </div>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold text-konfirmasi">
                                        1 / 1 
                                    </div>
                                    <div class="small text-">Telah<br>Dikonfirmasi</div>
                                </div>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold text-muted">
                                        1 / 1 
                                    </div>
                                    <div class="small text-muted">Belum<br>Dikonfirmasi</div>
                                </div>
                                <!-- <div>
                                    <div class="fs-4 fw-bold text-danger">
                                        $data['progress']['belum_mengusulkan']['count'] / $data['progress']['belum_mengusulkan']['total'] 
                                    </div>
                                    <div class="small text-muted">Belum<br>Mengusulkan</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-konfirmasi">
                                         $data['progress']['telah_dikonfirmasi']['count'] / $data['progress']['telah_dikonfirmasi']['total'] 
                                    </div>
                                    <div class="small text-">Telah<br>Dikonfirmasi</div>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-muted">
                                         $data['progress']['belum_dikonfirmasi']['count'] / $data['progress']['belum_dikonfirmasi']['total'] 
                                    </div>
                                    <div class="small text-muted">Belum<br>Dikonfirmasi</div>
                                </div> -->
                            </div>
                            <button type="button" class="btn mt-3 btn-blue" onclick="window.location.href='{{ route('dekan_PersetujuanJadwal') }}'">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Proggress Persetujuan Ruang Kuliah -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="fs-5 fw-semibold text-center">Persetujuan Ruang Kuliah</h3>
                            </div>
                            <p class="fs-6 fw-semibold mb-2">Anda belum mendapat usulan ruang kuliah</p>
                            <p class="text-muted mb-3">Silahkan kembali beberapa saat kedepan</p>
                            <button type="button" class="btn btn-blue" onclick="window.location.href='{{ route('dekan_PersetujuanRuang') }}'">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Calendar Section -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="material-icons text-teal me-2" style="color: blue">calendar_today</span>
                                <h3 class="fs-5 fw-semibold mb-0">Kalender Akademik</h3>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('kalender_akademik') }}" class="btn btn-outline-primary me-2">Lihat Kalender</a>
                                <button class="btn text-teal">
                                    <span class="material-icons">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
