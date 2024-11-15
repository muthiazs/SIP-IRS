<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS dan JS dari public -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>

    <!-- Menambahkan background secara langsung di file HTML -->
    <style>
        body {
            background-image: url("{{ asset('images/background_login.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            padding: 20px;
            width: 100%;
            max-width: 400px; /* Memberikan batas maksimal lebar agar tetap proporsional */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #FFF4EA;
            font-family: 'Poppins', sans-serif; /* Terapkan font Poppins ke seluruh body */
        }

        .btn-primary {
            margin-top: 20px;
            width: 100%; /* Tombol responsif */
            background-color: #16325B;
            border-color: #16325B;
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 768px) {
            .card {
                max-width: 90%; /* Pada layar lebih kecil, lebar akan menyesuaikan hingga 90% */
            }
        }

        @media (max-width: 480px) {
            .card {
                max-width: 100%; /* Pada layar kecil, lebar akan menyesuaikan 100% */
                padding: 15px;  /* Mengurangi padding agar lebih pas di layar kecil */
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-end">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Register</div>
                <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Lengkap:</label>
                        <input type="text" placeholder="nama kamu" 
                               id="nama" class="form-control" name="nama"
                               required autofocus>
                        @if ($errors->has('nama'))
                            <span class="text-danger">
                                {{$errors->first('nama')}}
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email:</label>
                        <input type="text" placeholder="email@gmail.com" 
                               id="email" class="form-control" name="email"
                               required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                {{$errors->first('email')}}
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password"
                               placeholder="****" name="password" required>
                        @if ($errors->has('password'))
                            <span class="text-danger">
                                {{$errors->first('password')}}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Daftar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>