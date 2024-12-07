<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Kalender Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
    <style>
        html, body {
            height: 100%; /* Full height */
            margin: 10; /* Remove default margin */
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #FFF2E5;
        }
        
        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card {
            width: 100%;
            height: 100%; /* Full height */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 0px;
        }

        .card-header {
            background-color: #027683;
            color: white;
            font-size: 18px;
        }

        .card-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .period-banner {
            margin-bottom: 20px;
            background-color: #027683;
            color: white;
        }

        .table thead th {
            background-color: #FED488;
            color: black;
            font-size: 14px;
            text-align: center;
        }

        .table tbody td {
            color: black;
            text-align: center;
            font-size: 12px;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card h-100">
            <h5 class="card-header">Kalender Akademik</h5>
            <div class="card-body">
                <div class="period-banner mb-1 text-center">
                    <span class="fw-medium">Daftar Kegiatan Akademik</span>
                </div>
                <div class="table-responsive">
                    <table id="kalenderTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kalenderAkademik as $kegiatan)
                                <tr>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d-m-Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JS Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kalenderTable').DataTable({
                responsive: true
            });
        });
    </script>
</body>
</html>
