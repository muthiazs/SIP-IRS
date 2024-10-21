<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', "SIP-IRS")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url("{{ asset('images/background_login.png') }}");
            background-size: cover; /* Membuat gambar menutupi seluruh area */
            background-repeat: no-repeat; /* Mencegah pengulangan gambar */
            background-size: 100%;
            padding-left: 750px;
            padding-top: 200px;
        }
        .card {
            margin: 0% auto;
            padding: 40px auto;
            max-width: 30px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5%;
            background-color: #FFF4EA;
        }
        .btn-primary {
            margin-bottom: 20px;
            background-color: #16325B;
            border-color: #16325B;
            margin-left: 45%;
            margin-right: 45%;
        }
    </style>
  </head>
  <body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>