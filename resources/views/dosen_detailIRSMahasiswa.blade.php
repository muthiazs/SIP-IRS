<!-- resources/views/dosen_detailIRSMahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail IRS Mahasiswa</title>
</head>
<body>
    <h1>Detail IRS Mahasiswa</h1>

    <!-- Data Dosen -->
    <section class="dosen-info">
        <h2>Data Dosen</h2>
        <p><strong>Nama Dosen:</strong> {{ $dosen->dosen_nama }}</p>
        <p><strong>Prodi:</strong> {{ $dosen->prodi_nama }}</p>
    </section>

    <!-- Data Mahasiswa -->
    <section class="mahasiswa-info">
        <h2>Data Mahasiswa</h2>
        <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
        <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
        <p><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</p>
        <p><strong>Prodi:</strong> {{ $mahasiswa->prodi_nama }}</p>
    </section>

    <!-- Data IRS -->
    <section class="irs-info">
        <h2>Daftar IRS Mahasiswa</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Matakuliah</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($irs as $item)
                    <tr>
                        <td>{{ $item->nama_matkul }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

</body>
</html>
