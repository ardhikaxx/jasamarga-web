<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasamarga - @yield('title', 'Login')</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --primary-blue: #00a4f4;
            --dark-blue: #0069ab;
            --text-dark: #3d3d3d;
            --text-light: #6d6d6d;
            --text-gray: #888888;
            --bg-light-blue: #f2faff;
            --white: #ffffff;
            --border-color: #e7e7e7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 10px;
            background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%);
            color: var(--white);
            font-size: 16px;
            font-weight: 700;
            border: none;
            padding: 10px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-login:hover {
            background: linear-gradient(142deg, #8fd8ff 0%, #007cb7 136.03%);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: var(--white)
        }

        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .btn-primary:hover {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
        }

        .swal2-popup {
            border-radius: 15px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .auth-card {
            width: 100%;
            max-width: 700px;
            border-radius: 20px;
            border: none;
            background-color: #DEF1FF;
            box-shadow: 0 10px 30px rgba(0, 149, 222, 0.15);
        }

        .auth-logo {
            max-width: 280px;
            width: 100%;
            height: auto;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 15px;
            height: 46px;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 164, 244, 0.25);
        }

        textarea.form-control {
            height: 100px;
            resize: none;
        }

        .form-label {
            color: var(--dark-blue);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .auth-btn {
            background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%);
            border: none;
            border-radius: 10px;
            font-weight: 700;
            height: 46px;
            font-size: 16px;
        }

        .auth-link {
            color: var(--dark-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .header-logo {
            max-width: 223px;
            width: 100%;
            height: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .auth-card {
                border-radius: 15px;
            }
            
            .card-body {
                padding: 25px !important;
            }
            
            .header-logo {
                max-width: 180px;
            }
            
            .btn-login {
                font-size: 14px;
                padding: 8px 12px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .card-body {
                padding: 20px 15px !important;
            }
            
            .header-logo {
                max-width: 150px;
            }
            
            .form-label {
                font-size: 15px;
            }
            
            .form-control {
                padding: 10px 12px;
                font-size: 14px;
            }
            
            .auth-btn {
                height: 44px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container mb-0">
        <div class="d-flex align-items-center justify-content-between pt-3">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" alt="Jasamarga Logo" class="header-logo">
            </a>
            @if(Request::is('login'))
                <a href="{{ url('/register') }}" class="btn btn-login">Register</a>
            @elseif(Request::is('register'))
                <a href="{{ url('/login') }}" class="btn btn-login">Login</a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-login">Login</a>
            @endif
        </div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500,
                background: '#DEF1FF',
                color: '#0069ab',
                iconColor: '#0095de',
                customClass: {
                    popup: 'swal2-popup'
                }
            });
        @endif
        
        @if(session('login_success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: 'Selamat datang di sistem Jasamarga',
                showConfirmButton: false,
                timer: 2500,
                background: '#DEF1FF',
                color: '#0069ab',
                iconColor: '#0095de',
                customClass: {
                    popup: 'swal2-popup'
                }
            });
        @endif
    </script>
</body>

</html>