<!-- resources/views/dashboard/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Draft IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
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
        .button-group-right {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Jarak antar tombol */
            margin-top: 15px; /* Jarak dari elemen atas */
        }



    </style> 
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
           
             <!-- Pengisian IRS Cards -->
        <div class="col-12">
            <div class="card shadow-sm h-100">
              <h5 class="card-header" style="background-color: #027683; color: white;">Pengisian Rencana Studi</h5>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="margincard">
                            <div class="fw-bold" style="font-size: 12px;">MAX BEBAN SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;">
                                {{ $maksimalSKS }} SKS
                            </span>
                        </div>
                        <div class="margincard" style="margin-left: 10px;">
                            <div class="fw-bold" style="font-size: 12px;">TOTAL SKS</div>
                            <span class="badge irs-badge" style="background-color: #67C3CC;">
                                {{ $totalSKSTerpilih }} SKS
                            </span>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="period-banner mb-1 text-center font-size: 12px" style="background-color: #027683; color: white;">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="fw-medium">Daftar Rencana Studi Sementara</span>
                </div>
            </div>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>SKS</th>
                    <th>Ruang</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="draftIRS">
                @foreach ($rancanganIRSSementara as $item => $rancanganSementara)
                    <tr>
                        <td>{{ $item + 1 }}</td>
                        <td>{{ $rancanganSementara->kode_matkul }}</td>
                        <td>{{ $rancanganSementara->nama_matkul }}</td>
                        <td>{{ $rancanganSementara->semester }}</td>
                        <td>{{ $rancanganSementara->kelas }}</td>
                        <td>{{ $rancanganSementara->sks }}</td>
                        <td>{{ $rancanganSementara->nama }}</td>
                        <td>{{ $rancanganSementara->hari }}</td>
                        <td>{{ $rancanganSementara->jam_mulai }}</td>
                        <td>{{ $rancanganSementara->jam_selesai }}</td>
                        <td>
                            <div class="button-group-tabel">
                            <form action="{{ route('batalkanJadwal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_jadwal" value="{{ $rancanganSementara->id_jadwal }}">
                                <input type="hidden" name="id_irs" value="{{ $rancanganSementara->id_irs }}"> <!-- Menambahkan id_irs -->
                                <button type="submit" class="btn btn-danger">Batalkan Jadwal</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="button-group-right">
            <a href="{{ route('mhs_pengisianIRS') }}" 
               class="btn btn-warning {{ !$isPeriodeAktif ? 'disabled' : '' }}" 
               style="margin-bottom:15px; @if(!$isPeriodeAktif) background-color: #ccc; border-color: #ccc; color: #fff; @endif">
                Kembali
            </a>
            <a href="{{ route('mhs_draftIRS') }}" 
               class="btn btn-warning" 
               style="background-color: #028391; border-color: #028391; color: #fff; margin-bottom:15px">
                Draft IRS
            </a>
            <form action="{{ route('konfirmasi_irs') }}" method="POST" id="konfirmasiForm">
                @csrf
                <button type="submit" 
                        class="btn btn-info" 
                        id="konfirmasiBtn" 
                        style="color: white; background-color: #6878B1; margin-bottom:15px; margin-right:10px">
                    Konfirmasi
                </button>
            </form>
        </div>
        
    </div>
  </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.batalBtn', function() {
        var id_jadwal = $(this).data('id');  // Ambil id_jadwal dari atribut data-id

        Swal.fire({
            title: 'Batal Jadwal',
            text: 'Apakah Anda yakin ingin membatalkan jadwal ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('batalkanJadwal') }}',  // Sesuaikan dengan route yang tepat
                    type: 'POST',
                    data: {
                        id_jadwal: id_jadwal,
                        _token: '{{ csrf_token() }}'  // Kirim csrf token
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Dibatalkan!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();  // Reload halaman setelah berhasil
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Terjadi kesalahan!',
                            'Silakan coba lagi.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
    @endif

    @if(session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: '{{ session('warning') }}',
        confirmButtonText: 'OK'
    });
    @endif

    document.getElementById('konfirmasiForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi Rencana Studi',
            text: 'Apakah Anda yakin ingin mengajukan Rencana Studi?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ajukan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>

