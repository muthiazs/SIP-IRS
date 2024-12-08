<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-IRS Login</title>
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
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

.login-container {
    display: flex;
    width: 100%;
    height: 100vh;
}

/* Sidebar */
.login-sidebar {
    background-image: url("{{ asset('images/login_sidebar.png') }}");
    background-size: cover;
    background-position: center;
    width: 50%; /* Set sidebar width to 50% */
    height: 100vh;
}

/* Content area */
.login-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 50%; /* Set content area width to 50% */
    padding: 0 20px; /* Add some padding */
}

/* Card Styling */
.card {
    padding: 20px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    background-color: #FFF4EA;
}

/* Button Styling */
.btn-primary {
    margin-top: 20px;
    width: 100%;
    background-color: #16325B;
    border-color: #16325B;
}

/* Responsiveness */
@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
    }

    .login-sidebar {
        width: 100%;
        height: auto;
    }

    .login-content {
        width: 100%;
    }

    .card {
        max-width: 90%;
    }
}

@media (max-width: 480px) {
    .login-content {
        width: 100%;
    }

    .card {
        max-width: 100%;
        padding: 15px;
    }
}

    </style>
</head>
<body>
    <div class="login-container">
        <!-- Sidebar -->
        <div class="login-sidebar"></div>

        <!-- Content Area -->
        <div class="login-content">
            <!-- Logo -->
            <img src="{{ asset('images/sip-irs_logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px;">

            <!-- Card Login -->
            <div class="card">
                <div class="card-header text-center">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Email:</label>
                            <input type="text" placeholder="email@university.ac.id" 
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
                            <input type="password" class="form-control" id="password" placeholder="****" 
                                   name="password" required autocomplete="current-password">
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                    {{$errors->first('password')}}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
