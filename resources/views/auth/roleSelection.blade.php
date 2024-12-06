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
                <div class="card-header text-center">Pilih Role Dosen</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('handleRoleSelection') }}">
                        @csrf
                        <div>
                            <label>
                                <input type="radio" name="role" value="dekan" required>
                                Dekan
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="radio" name="role" value="kaprodi" required>
                                Kaprodi
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="radio" name="role" value="dosen_wali" required>
                                Dosen Wali
                            </label>
                        </div>
                        <form action="{{ route('handleRoleSelection') }}" method="POST">
                            @csrf
                            <!-- Form fields for role selection -->
                            <button class='btn-primary text-white' type="submit">Pilih Role</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    fetch('/handleRoleSelection', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for Laravel
    },
    body: JSON.stringify({
        role: selectedRole // selectedRole is the role chosen by the user
    })
})
.then(response => response.json())
.then(data => {
    // Handle response
})
.catch(error => {
    console.error('Error:', error);
});

</script>
