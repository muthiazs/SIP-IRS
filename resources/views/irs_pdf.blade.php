<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rencana Studi IRS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin-top: 20px;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
        }

        table, th, td {
            border: 1px solid #3498db;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .note {
            font-size: 12px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        IRS MAHASISWA 
    </div>
      <!-- Student Info -->
      <div class="student-info">
        <p><strong>Nama Mahasiswa:</strong> {{ $mahasiswa->nama }}</p>
        <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
    </div>
    <div class="table-container">
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
</body>
</html>
