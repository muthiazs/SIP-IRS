<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengisian Rencana Studi - SIP-IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4 position-relative">
            <div class="text-center mb-4">
                <div class="profile-img mb-3">
                    <span class="material-icons" style="font-size: 48px; color: var(--primary-color)">person</span>
                </div>
                <h5 class="mb-1">{{ $data['mahasiswa']['name'] }}</h5>
                <p class="small mb-1">NIM. {{ $data['mahasiswa']['nim'] }}</p>
                <p class="small mb-1">{{ $data['mahasiswa']['program_studi'] }}</p>
                <p class="small mb-1">{{ $data['user']['name'] }}</p>
                <p class="small">NIP. {{ $data['user']['nip'] }}</p>
            </div>

            <nav class="nav flex-column gap-2 mb-4">
                <a href="/dashboardMahasiswa" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">home</span>
                    Beranda
                </a>
                <a href="/pengisianIRS" class="nav-link active rounded d-flex align-items-center">
                    <span class="material-icons me-3">description</span>
                    Rencana Studi
                </a>
                <a href="#" class="nav-link rounded d-flex align-items-center">
                    <span class="material-icons me-3">assessment</span>
                    Hasil Studi
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-logout position-absolute bottom-0 mb-4 rounded-3">
                <a href="/login">
                    <span class="material-icons align-middle me-2">logout</span>
                    Keluar
                </a>
            </button>

             <!-- Wave decoration -->
             <div class="wave-decoration">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 200%; width: 175%;">
                    <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
                </svg>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Selamat Datang {{ $data['mahasiswa']['name'] }} 👋</h1>
                    <p class="text-muted mb-0">Semester Akademik {{ $data['semester']['current'] }}</p>
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
                    <span class="fw-medium">{{ $data['semester']['period'] }}</span>
                </div>
            </div>

        <!-- Pengisian IRS Cards -->
        <div class="col-12">
            <div class="card shadow-sm h-100">
              <h5 class="card-header" style="background-color: #027683; color: white;">Pengisian Rencana Studi</h5>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="margincard">
                            <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;">{{ $data['pengisianirs']['maxbeban'] }} SKS</span>
                        </div>
                        <div class="margincard" style="margin-left: 10px;">
                            <div class="fw-bold" style="font-size: 12px;">TOTAL SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;">{{ $data['pengisianirs']['total'] }} SKS</span>
                        </div>
                    </div>
                    <div>
                        <div class="margincard">
                            <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            <button class="btn btn-pilihmk">
                                <a href="/pengambilanMatkul" class="nav-link active">
                                    Pilih Mata Kuliah
                                </a> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                  <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari Mata Kuliah" aria-label="Search">
                    <button class="btn btn-outline-blue" type="submit" style="background-color: #6878B1; color: white">Cari</button>
                  </form>
                </div>
            </nav> --}}

            <div class="card-body">
                <table class="table table-borderless" style="background-color: #fef3c7">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>06.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>07.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>08.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>09.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>10.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>11.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>12.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>13.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>14.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>15.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>16.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>17.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                        <tr>
                            <td>18.00</td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td> <td><div class="slot"></div></td>
                            <td><div class="slot"></div></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>