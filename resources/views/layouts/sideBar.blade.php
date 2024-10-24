<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk sidebar */
        .sidebar {
            background-color: #008B8B;
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        
        .sidebar .nav-link {
            color: white;
            margin: 5px 0;
            padding: 10px 20px;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
        }

        .profile-section {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #f8f9fa;
            margin: 0 auto 10px;
        }

        .status-badge {
            background-color: #6c757d;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .content-section {
            padding: 20px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .info-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .notification-icon {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="profile-section">
                    <div class="profile-image"></div>
                    <h4>{{ Auth::user()->username }}</h4>
                    <div class="status-badge">
                        Tidak Aktif
                    </div>
                    <p class="mb-0">NIM {{ Auth::user()->username }}</p>
                    <p class="mb-0">S1 Informatika</p>
                    <p class="mb-2">Dosen Wali: Bill Gates</p>
                </div>
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home me-2"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-book me-2"></i> Rencana Studi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-graduation-cap me-2"></i> Hasil Studi
                        </a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content-section">
                <!-- Notification Icon -->
                <div class="d-flex justify-content-end mb-4">
                    <div class="notification-icon">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="notification-badge">1</span>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>