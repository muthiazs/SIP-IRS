<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Persetujuan Ruang</title>
    <!-- jQuery HARUS PERTAMA -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Kemudian Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    

    <style>
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
            table-layout: fixed; /* Ukuran kolom tetap */
            width: 100%; /* Pastikan tabel mengambil seluruh lebar kontainer */
        }
        
        .table th, .table td {
            word-wrap: break-word; /* Agar teks yang panjang tidak melar keluar kolom */
            text-align: center; /* Pusatkan teks */
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
        .button-group-right {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Jarak antar tombol */
            margin-top: 15px; /* Jarak dari elemen atas */
            margin-bottom: 15px;
            margin-right: 15px; 
        }
        .button-group-tabel {
            display: flex;
            justify-content: center;
            gap: 5px; /* Jarak antar tombol */
        }

        /* Adjust search bar size */
        .searchInput {
            max-width: 300px; /* Sesuaikan ukuran maksimal */
        }

        /* Optional: Add spacing between buttons */
        .input-group .btn {
            margin-left: 5px; /* Tambahkan jarak antar tombol */
        }

        .card-body {
            overflow-x: auto; /* Agar tabel tidak keluar dari card */
            padding: 15px; /* Tambahkan padding agar terlihat rapi */
            width: auto; /* Sesuaikan lebar dengan konten */
            max-width: 100%; /* Pastikan tidak melebihi layar */
            box-sizing: border-box; /* Hitung padding dalam ukuran elemen */
        }

        .card {
            width: auto; /* Sesuaikan ukuran card dengan kontennya */
            max-width: 100%; /* Agar tidak melebihi layar */
        }

        /* Konfirmasi button position */
        .confirm-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3085d6;
            color: white;
            border-radius: 50%;
            padding: 15px;
            font-size: 20px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .confirm-button:hover {
            background-color: #277bb5;
        }

    </style>

</head>
<body class="bg-light">
    <div class="d-flex">
        <x-sidebar-dekan :dekan="$dekan"></x-sidebar-dekan>
        <!-- Wave decoration -->
        <div class="wave-decoration"> 
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 35%; width: 35%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <!-- Form untuk Setujui Semua Ruang -->
            <form action="{{ route('setujui.semua.ruang') }}" method="POST">
                @csrf
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Persetujuan Ruang Kelas</h4>
                </div>

                <!-- Period Banner -->
                <div class="period-banner p-3 rounded-3 mb-4 d-flex justify-content-between">
                    <span>Periode Persetujuan Ruang Kelas</span>
                </div>

                <!-- Dropdown Program Studi -->
                <div class="mb-3">
                    <label class="fw-bold">Program Studi</label>
                    <select name="prodi" class="form-select" id="selectProdi" required>
                        <option value="">Pilih Program Studi</option>
                        <option value="Biologi">Biologi</option>
                        <option value="Bioteknologi">Bioteknologi</option>
                        <option value="Fisika">Fisika</option>
                        <option value="Kimia">Kimia</option>
                        <option value="Matematika">Matematika</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Statistika">Statistika</option>
                    </select>
                </div>

                <!-- Button Setujui Semua -->
                <button type="submit" class="btn btn-success mb-4">Setujui Semua Ruang</button>
            </form>

            <!-- Tabel Persetujuan Ruang -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 3rem;">No</th>
                        <th style="width: 5rem;">Ruang</th>
                        <th style="width: 4rem;">Kuota</th>
                        <th style="width: 8rem;">Program Studi</th>
                        <th style="width: 5rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelRuang">
                    @foreach($accRuang as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->ruang_nama }}</td>
                            <td>{{ $data->kapasitas }}</td>
                            <td>{{ $data->prodi_nama }}</td>
                            <td>
                                <!-- Form untuk Setujui Ruang -->
                                <form action="{{ route('setujui.ruang', ['id_ruang' => $data->id_ruang]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>

                                <!-- Tombol Tolak
                                <form action="{{ route('tolak.ruang', ['id_ruang' => $data->id_ruang]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form> -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    <!-- Konfirmasi Button -->
    <button class="btn btn-blue position-absolute bottom-0 mb-4 rounded-3" onclick="confirmButton()">Konfirmasi</button>
    <!-- Tombol Setujui Semua -->
    


    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script>
        // Button click event
        function confirmButton() {
            Swal.fire({
                title: 'Konfirmasi Penyetujuan Jadwal Kuliah',
                text: 'Apakah Anda yakin ingin menyetujui jadwal kuliah ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setujui',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aksi yang terjadi setelah konfirmasi, bisa diarahkan ke route
                    window.location.href = '#'; // Ganti dengan route yang sesuai
                }
            });
        }
    </script>

    <!-- Toastr -->
    <script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "escapeHtml": true
        }
    });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dropdown Logic -->
    <script>
        $(document).ready(function() {
            $('#selectProdi').change(function() {
                const prodi = $(this).val().trim().toLowerCase();
                $('#tabelRuang tr').each(function() {
                    const namaProdi = $(this).find('td:eq(3)').text().trim().toLowerCase();
                    if ( namaProdi.includes(prodi)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event handler untuk form
            const form = document.querySelector('form[action="{{ route('setujui.semua.ruang') }}"]');

            if (form) {
                // form.addEventListener('submit', function(e) {
                //     e.preventDefault(); // Mencegah submit default

                    // const prodi = document.getElementById('selectProdi').value.trim();
                    // if (!prodi) {
                    //     Swal.fire({
                    //         title: 'Pilih Program Studi',
                    //         text: 'Silakan pilih program studi terlebih dahulu.',
                    //         icon: 'warning',
                    //         confirmButtonText: 'OK'
                    //     });
                    //     return; // Stop jika program studi tidak dipilih
                    // }

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Apakah Anda yakin ingin menyetujui semua ruangan untuk program studi ${prodi}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Setujui Semua',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Lakukan submit jika dikonfirmasi
                        }
                    });
                });
            }

            // SweetAlert untuk pesan sukses/error dari session
            @if(session('sweetAlert'))
                const alert = @json(session('sweetAlert'));
                Swal.fire({
                    title: alert.title,
                    text: alert.text,
                    icon: alert.icon,
                    confirmButtonColor: '#028391',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

</body>
</html>
