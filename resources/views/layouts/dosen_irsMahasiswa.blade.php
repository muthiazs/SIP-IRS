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
        <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
       .wrapper {
            display: flex;
            min-height: 100vh;
        }
        /* Tabel IRS */
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

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include ('sidebar')


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
                <table class="table table-bordered">
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