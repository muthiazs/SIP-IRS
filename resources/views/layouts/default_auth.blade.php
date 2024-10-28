<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', "SIP-IRS")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Tambahkan CSS untuk responsivitas -->
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
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
