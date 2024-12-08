<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Detail IRS Mahasiswa</title>
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
        <!--Main Content-->
        <div class="main-content flex-grow-1 p-4">
            <header class="header">
                <div>
                    <h1 class="fs-3 fw-bold"> Detail IRS Mahasiswa 👩🏻‍💻</h1>
                    <p class="text-muted">Semester Akademik Sekarang</p>
                </div>
            </header>
            <div class="period-banner p-3 rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-teal">Periode Penyetujuan IRS</span>
                    <span class="text-teal fw-bold">...-...</span>
                </div>
            </div>

            <!-- Nama Mahasiswa -->
            <h3 class="fw-bold mb-4">{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</h3>
             <!-- Tombol untuk mengunduh IRS dalam format PDF -->
            <div class="print-btn">
                <a href="{{ route('dosen.print_irs_pdf', $mahasiswa->nim) }}" class="btn btn-primary mb-4" >Unduh Histori IRS</a>
            </div>
            <!-- Tabel IRS -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>SKS</th>
                        <th>Ruang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($irs as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->mata_kuliah }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->sks }}</td>
                        <td>{{ $item->ruang }}</td>
                        <td><span class="badge 
                            @if($item->status == 'belum disetujui') bg-warning 
                            @elseif($item->status == 'disetujui') bg-success 
                            @else bg-secondary 
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data IRS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="btn-group" role="group" aria-label="IRS Approval Actions">
                <!-- Tombol Kembali -->
                <a href="/dosen_irsMahasiswa" class="btn btn-warning">Kembali</a>
                
                <!-- Tombol Setujui dengan konfirmasi -->
                <button type="button" class="btn btn-success" onclick="confirmApproval('approve')">Setujui</button>
                
                <!-- Tombol Batalkan Persetujuan dengan konfirmasi -->
                <button type="button" class="btn btn-danger" onclick="confirmApproval('cancel')">Batalkan Persetujuan</button>
            </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmApproval(action) {
        const messages = {
            'approve': {
                title: 'Setujui IRS',
                text: 'Apakah Anda yakin ingin menyetujui IRS mahasiswa ini?',
                confirmButtonText: 'Ya, Setujui',
                successMessage: 'IRS berhasil disetujui!'
            },
            'cancel': {
                title: 'Batalkan Persetujuan',
                text: 'Apakah Anda yakin ingin membatalkan persetujuan IRS? Tindakan ini tidak dapat dibatalkan.',
                confirmButtonText: 'Ya, Batalkan',
                successMessage: 'Persetujuan IRS berhasil dibatalkan!'
            }
        };

        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: messages[action].title,
            text: messages[action].text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: messages[action].confirmButtonText,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi diterima, redirect ke action terkait
                if (action === 'approve') {
                    window.location.href = '{{ route('dosen.approve.irs', ['nim' => $mahasiswa->nim]) }}';
                } else if (action === 'cancel') {
                    window.location.href = '{{ route('dosen.cancel.approval.irs', ['nim' => $mahasiswa->nim]) }}';
                }
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: true,  // Menampilkan tombol konfirmasi
            confirmButtonText: 'Tutup'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            showConfirmButton: true,  // Menampilkan tombol konfirmasi
            confirmButtonText: 'Tutup'
        });
    @endif
</script>
</html>
