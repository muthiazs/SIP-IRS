<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rencana Studi IRS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rencana Studi IRS</h1>
        <p>Nama Mahasiswa: {{ $mahasiswa->nama }}</p>
        <p>NIM: {{ $mahasiswa->nim }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Matakuliah</th>
                <th>Semester</th>
                <th>Kelas</th>
                <th>SKS</th>
                <th>Ruang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($irs as $item)
                <tr>
                    <td>{{ $item->nama_matkul }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->sks }}</td>
                    <td>{{ $item->ruang }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
