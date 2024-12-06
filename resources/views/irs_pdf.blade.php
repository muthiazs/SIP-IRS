<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak IRS</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header p {
            margin: 5px 0;
        }

        .header-title {
            font-size: 15px;
            font-weight: bold;
            color: #000000;
        }

        .sub-title {
            font-size: 15px;
            margin-top: 20px;
            font-weight: bold;
            color: #000000;
            text-align: center;
        }

        .info-section {
            margin-top: 20px;
            font-size: 14px;
        }

        .info-section p {
            margin: 5px 0;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #000000;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #169281;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <p class="header-title">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</p>
            <p class="header-title">FAKULTAS SAINS DAN MATEMATIKA</p>
            <p class="header-title">UNIVERSITAS DIPONEGORO</p>
        </div>

        <!--  Info -->
        <div class="info-section">
            <p><strong>Nama Mahasiswa:</strong> {{ $mahasiswa->nama }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>Program Studi:</strong> {{ $mahasiswa->nama_prodi }}</p>
            <p><strong>Nama Pembimbing:</strong> {{ $pembimbing->nama_pembimbing }}</p>
            <p><strong>NIP:</strong> {{ $pembimbing->nip }}</p>
        </div>
        <div class="info-section">
            <p><strong>Total SKS:</strong> {{ $totalSKS }}</p>
        </div>

        <!-- Table -->
        <div class="table-container">
            <p class="sub-title">Isian Rencana Studi Semester {{ $semester }}</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>SKS</th>
                        <th>Ruang</th>
                        <th>Status</th>
                        <th>Nama Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($irs as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kode_matkul }}</td>
                        <td>{{ $item->nama_matkul }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->sks }}</td>
                        <td>{{ $item->ruang }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->nama_dosen }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dihasilkan secara otomatis melalui SIP-IRS.</p>
        </div>
    </div>
</body>
</html>
