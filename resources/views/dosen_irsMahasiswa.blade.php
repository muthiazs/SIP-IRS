<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRS Mahasiswa Perwalian - SIP-IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .filter-search {
            gap: 10px; /* Jarak antara filter dropdown dan search bar */
        }
        .filter-search .form-select {
            width: 200px; /* Lebar dropdown */
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <x-sidebar-dosen :dosen="$dosen"></x-sidebar-dosen>
        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <header class="header">
                    <h1>IRS Mahasiswa</h1>
                    <p>Semester Akademik Sekarang 2024/2025 Ganjil</p>
                    <h2>Periode Penyetujuan IRS</h2>
            </header>

            <!-- Filter and Search -->
            <section class="filter-search mt-2 d-flex align-items-start">
                <!-- Filter Dropdown -->
                <div class="filter-group me-3">
                    <label for="filter-dropdown" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="filter-dropdown">
                        <option value="all">Semua</option>
                        <option value="pending">Belum Disetujui</option>
                        <option value="approved">Sudah Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
            
                <!-- Angkatan Dropdown -->
                <div class="angkatan-group me-3">
                    <label for="angkatan-dropdown" class="form-label fw-bold">Angkatan</label>
                    <select class="form-select" id="angkatan-dropdown">
                        <option value="all">Semua</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            
                <!-- Search Bar -->
                <div class="search-group">
                    <label for="search-input" class="form-label fw-bold">Cari</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama" id="search-input">
                        <button class="btn" style="background-color: #6878B1; color:#fff" type="button" id="search-button">
                            <span class="material-icons">search</span>
                        </button>
                    </div>
                </div>
            </section>
           
            <!-- Student List -->
            <section class="student-list mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>NIM</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="student-list">
                        <!-- Student data will be dynamically added here -->
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
            { no: 3, nama: 'Rizky Pratama', angkatan: 2023, nim: '2406012313001', status: 'Ditolak' }
        ];

        // Render student data with reset numbering and checkboxes
        function renderStudents(filteredStudents) {
            studentList.innerHTML = ''; // Kosongkan tabel lama
            let nomor = 1; // Mulai nomor dari 1
            filteredStudents.forEach((student) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="checkbox" class="form-check-input student-checkbox"></td>
                    <td>${nomor++}</td>
                    <td>${student.nama}</td>
                    <td>${student.angkatan}</td>
                    <td>${student.nim}</td>
                    <td>${student.status}</td>
                `;
                const aksiCell = document.createElement('td');
                const link = document.createElement('a');
                link.href = `#`; // Replace '#' with actual route to rencana studi
                link.classList.add('aksi-link');
                link.textContent = 'Lihat Detail';
                aksiCell.appendChild(link);

                row.appendChild(aksiCell);
                studentList.appendChild(row);
            });
        }

        renderStudents(students); // Initial render

        // Mapping filter values to corresponding status
        const filterDropdown = document.getElementById('filter-dropdown');

        // Mapping filter values to corresponding status
        const filterMap = {
            all: null,
            pending: "Belum Disetujui",
            approved: "Disetujui",
            rejected: "Ditolak"
        };

        // Event listener untuk filter dropdown
        filterDropdown.addEventListener('change', () => {
            const filterValue = filterDropdown.value;
            const statusToFilter = filterMap[filterValue]; // Map ke status yang sesuai

            // Filter data mahasiswa
            const filteredStudents = students.filter(student =>
                !statusToFilter || student.status === statusToFilter
            );

            renderStudents(filteredStudents); // Render data berdasarkan filter
        });

        // Filter functionality
        const filterButtons = document.querySelectorAll('[data-filter]');

        // Set default active button on page load
        window.addEventListener('DOMContentLoaded', () => {
            const defaultButton = document.querySelector('[data-filter="all"]');
            defaultButton.classList.add('active'); // Set "Semua" as active by default
        });

        filterButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const filterValue = e.target.dataset.filter;
                const statusToFilter = filterMap[filterValue]; // Map to corresponding status

                // Filter students based on the selected filter
                const filteredStudents = students.filter(student =>
                    !statusToFilter || student.status === statusToFilter
                );

                renderStudents(filteredStudents);

                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to the clicked button
                e.target.classList.add('active');
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

        // Select All Checkbox functionality
        const selectAllCheckbox = document.getElementById('select-all');

        selectAllCheckbox.addEventListener('change', () => {
            const studentCheckboxes = document.querySelectorAll('.student-checkbox');
            const isChecked = selectAllCheckbox.checked;

            // Update all student checkboxes based on the header checkbox
            studentCheckboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
        });

        // Referensi ke dropdown Angkatan
        const angkatanDropdown = document.getElementById('angkatan-dropdown');

        // Perbarui filter map untuk memasukkan logika angkatan
        let selectedAngkatan = "all"; // Default: Semua
        let selectedStatus = null; // Default: Semua status

        // Event Listener untuk Angkatan Dropdown
        angkatanDropdown.addEventListener('change', () => {
            selectedAngkatan = angkatanDropdown.value; // Dapatkan nilai angkatan terpilih
            applyFilters(); // Terapkan filter setelah perubahan
        });

        // Event Listener untuk Filter Status
        filterButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                selectedStatus = filterMap[e.target.dataset.filter]; // Pindahkan logika ke variabel global
                applyFilters(); // Terapkan filter setelah perubahan
            });
        });

        // Fungsi untuk memfilter berdasarkan Angkatan dan Status
        function applyFilters() {
            let filteredStudents = students;

            // Filter berdasarkan angkatan (jika tidak "all")
            if (selectedAngkatan !== "all") {
                filteredStudents = filteredStudents.filter(student => 
                    student.angkatan === parseInt(selectedAngkatan)
                );
            }

            // Filter berdasarkan status (jika tidak null)
            if (selectedStatus) {
                filteredStudents = filteredStudents.filter(student => 
                    student.status === selectedStatus
                );
            }

            // Tampilkan hasil dengan nomor urut ulang
            renderStudents(filteredStudents);
        }

        // Logout function
        function logout() {
            alert('Logout button clicked!');
            // Add your logout logic here
        }
    </script>
</body>

</html>