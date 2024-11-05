<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRS Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        
        :root {
            --primary-color: #0d9488;
            --secondary-color: #99f6e4;
            --accent-color: #fef3c7;
        }

        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            width: 280px;
            color: white;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            background-color: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .nav-link {
            color: white !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .status-card {
            background-color: var(--accent-color);
            border-radius: 15px;
            padding: 20 px;
            margin-bottom: 20px;
        }

        .stats-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .period-banner {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 10px;
            padding: 15px 20px;
        }

        .btn-logout {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            opacity: 0.9;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .wave-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            opacity: 0.1;
        }
    </style> <style>
        /* Buat Side bar */
        .sidebar {
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: #027683;
            min-height: 100vh;
            width: 280px;
        }
        .profile-img {
            width: 96px;
            height: 96px;
            background-color: #fef3c7;
        }

        /* Buat tulisan di side bar nya */
        .nav-link {
            color: white !important;
            font-family: 'Poppins';
            border-radius: 30px; /* Menambahkan kelengkungan pada navigasi */
            padding: 10px 15px;
            transition: background-color 0.3s ease; /* Transisi halus saat dihover */
        }

        /* Buat saat whilehover */
        .nav-link:hover {
            background-color: #359ca7;
            border-radius: 30px; /* Agar saat dihover, tetap rounded */
        }

        /* Buat saaat onclick */
        .nav-link.active {
            color: black !important;
            background-color: #F6DCAC !important;
            border-radius: 30px; /* Menjaga navigasi tetap rounded saat aktif */
        }

        /* Button Lonceng Notifikasi */

        .btn-notification {
            position: relative; /* Posisi relative untuk badge */
            background-color: #027683;
            border: 2px solid #027683; /* Warna border sesuai sidebar */
            border-radius: 100%; /* Membuatnya bulat */
            padding: 10px; /* Menambahkan padding untuk ukuran button */
            transition: background-color 0.3s ease; /* Transisi saat hover */
        }


        .btn-notification:hover {
            background-color: #5db0b9;
        }

        /* Warna bulatan merah untuk notifikasi */
        .notification-badge {
            width: 15px; 
            height: 15px;
            background-color: #dc3545; /* Warna merah untuk notifikasi */
            border-radius: 50%;
            position: absolute;
            top: 0; /* Atur posisi vertikal */
            right: 0; /* Atur posisi horizontal */
            transform: translate(5%, -5%); /* Untuk memindahkan badge ke sudut tombol */
        }

        /* Buat pengumuman periode */
        .period-banner {
            background-color: #67C3CC;
        }

        .btn-logout {
            font-family: 'Poppins';
            background-color: #FED488;
            color: black;
            right: 50px;
        }
        
        .text-teal {
            color: white;
        }

        .text-konfirmasi{
            color: #028391;
        }

        .card{
            background: #FFF2E5;
            border-radius: 30px;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
        }

        .table th, .table td {
            padding: 10px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e9e9e9;
        }

        .table td {
            vertical-align: middle;
        }

        .table .btn {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }

        .table .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
        }

        .table .btn-outline-primary {
            border: 1px solid #007bff;
            color: #007bff;
        }

        .table .btn-outline-primary:hover {
            background-color: #007bff;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar p-4 text-white position-relative">
            <!-- Profile Section -->
            <div class="text-center mb-4">
                <div class="profile-img rounded-circle mx-auto mb-3">
                    <!-- Profile image placeholder -->
                </div>
                <h2 class="fs-4 fw-bold">Bill Gates</h2>
                <p class="small opacity-75">NIP.198203092006041002</p>
                <p class="small opacity-75">Program Studi S1 Informatika</p>
            </div>

            <!-- Navigation -->
            <nav class="nav flex-column gap-2">
                <a href="#" class="nav-link active rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">home</span>
                    Beranda
                </a>
                <a href="{{ route('irsMahasiswa') }}" class="nav-link rounded d-flex align-items-center p-3">
                    <span class="material-icons me-2">description</span>
                    IRS Mahasiswa
                </a>
            </nav>

            <!-- Logout Button -->
            <button class="btn btn-danger position-absolute bottom-0 mb-4 rounded-3" onclick="logout()">
                Keluar
            </button>

            <!-- Wave decoration -->
            <div class="wave-decoration">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                    <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                        style="stroke: none; fill: #fff;"></path>
                </svg>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <header class="header">
                    <h1>IRS Mahasiswa</h1>
                    <p>Semester Akademik Sekarang 2024/2025 Ganjil</p>
                    <h2>Periode Penyetujuan IRS</h2>
            </header>

            <!-- Filter and Search -->
            <section class="filter-search">
                <div>
                    <button class="btn btn-primary" data-filter="all">Semua</button>
                    <button class="btn btn-outline-primary" data-filter="pending">Belum Disetujui</button>
                    <button class="btn btn-outline-primary" data-filter="approved">Sudah Disetujui</button>
                    <button class="btn btn-outline-primary" data-filter="rejected">Ditolak</button>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama" id="search-input">
                    <button class="btn btn-primary" type="button" id="search-button">
                        <span class="material-icons">search</span>
                    </button>
                </div>
            </section>

            <!-- Student List -->
            <section class="student-list">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>NIM</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="student-list">
                        <!-- Student data will be rendered here -->
                    </tbody>
                </table>
            </section>
        </div>
    </div>
        <!-- Footer -->
        <footer>
            <p>&copy; 2024 IRS Mahasiswa</p>
        </footer>
    

    <script>
        const studentList = document.getElementById('student-list');
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        // Sample data
        const students = [
            { no: 1, nama: 'Muthia Zhafira Sahnah', angkatan: 2022, nim: '24060122130071', status: 'Disetujui' },
            { no: 2, nama: 'Alya Safina', angkatan: 2022, nim: '2406012213002', status: 'Belum Disetujui' },
            // Add more students here
        ];

        // Render student data
        function renderStudents(filteredStudents) {
            studentList.innerHTML = ''; // Clear existing rows
            filteredStudents.forEach((student) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.no}</td>
                    <td>${student.nama}</td>
                    <td>${student.angkatan}</td>
                    <td>${student.nim}</td>
                    <td>${student.status}</td>
                `;
                studentList.appendChild(row);
            });
        }

        renderStudents(students); // Initial render

        // Filter functionality
        const filterButtons = document.querySelectorAll('[data-filter]');
        filterButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const filterValue = e.target.dataset.filter;
                const filteredStudents = students.filter(student =>
                    filterValue === 'all' || student.status === filterValue
                );
                renderStudents(filteredStudents);
                filterButtons.forEach(btn => btn.classList.remove('active'));
                e.target.classList.add('active'); // Add active class to the selected button
            });
        });

        // Search functionality
        searchButton.addEventListener('click', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredStudents = students.filter(student =>
                student.nama.toLowerCase().includes(searchTerm)
            );
            renderStudents(filteredStudents);
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                searchButton.click(); // Trigger search on Enter key
            }
        });

        // Logout function
        function logout() {
            alert('Logout button clicked!');
            // Add your logout logic here
        }
    </script>
</body>

</html>