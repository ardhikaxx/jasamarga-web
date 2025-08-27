<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasamarga - Tol Surabaya Gempol</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Manrope', sans-serif;
            background-color: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 24px;
            line-height: 1;
            text-align: center;
            cursor: pointer;
            border: none;
            box-shadow: -8px 8px 28px 0px rgba(0, 0, 0, 0.06);
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 10px;
            background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%);
            color: var(--white);
            font-size: 20px;
            font-weight: 800;
            border: none;
            padding: 16px 24px;
            height: 46px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(142deg, #8fd8ff 0%, #007cb7 136.03%);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 10px;
            background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%);
            color: var(--white);
            font-size: 20px;
            font-weight: 800;
            border: none;
            padding: 16px 24px;
            height: 46px;
            cursor: pointer;
            transition: all 0.3s ease;
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

        .navbar {
            padding: 16px 0;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1020;
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            padding: 8px 15px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--dark-blue);
            font-weight: 700;
        }

        /* Underline animation for active nav item
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background-color: var(--dark-blue);
            transition: width 0.3s ease, left 0.3s ease;
        } */

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: calc(100% - 30px);
            left: 50%;
            transform: translateX(-50%);
        }

        /* Smooth scroll offset for fixed navbar */
        section {
            scroll-margin-top: 80px;
        }

        .hero-section {
            position: relative;
            height: 758px;
            background: linear-gradient(166deg, #f2faff 0%, #ffffff 90.79%);
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-bg-image-wrapper {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 604px;
            -webkit-mask-image: linear-gradient(to bottom, #000000 50.96%, rgba(0, 0, 0, 0.44) 86.06%, rgba(0, 0, 0, 0) 100%);
            mask-image: linear-gradient(to bottom, #000000 50.96%, rgba(0, 0, 0, 0.44) 86.06%, rgba(0, 0, 0, 0) 100%);
        }

        .hero-bg-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-vector-overlay {
            position: absolute;
            bottom: -133px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }

        .info-title {
            font-size: 64px;
            font-weight: 700;
            line-height: 52px;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .info-title .gradient-text {
            background: linear-gradient(90deg, #88d8ff 12.37%, #0179b4 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .info-description {
            font-size: 16px;
            font-weight: 600;
            line-height: 24px;
            color: #333333;
        }

        .info-description a {
            text-decoration: underline;
        }

        .location-card {
            background: radial-gradient(173.07% 205.27% at 50% 50%, #ffffff 32.81%, #f8fdff 97.64%);
            border-radius: 28px;
            box-shadow: 3.12px 9.37px 21.85px 0px rgba(0, 0, 0, 0.06);
            padding: 31px 40px 62px;
            border: 2px solid var(--primary-blue);
        }

        .location-title {
            color: var(--dark-blue);
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 40px;
            line-height: 1;
            letter-spacing: 3.6px;
            text-align: center;
            margin-bottom: 69px;
        }

        .form-group-header {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 8px;
            gap: 8px;
        }

        .form-group-header label {
            color: var(--text-gray);
            font-size: 16px;
            font-weight: 600;
        }

        .form-icon {
            width: 26px;
            height: 26px;
        }

        .input-wrapper {
            background-color: var(--white);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            height: 46px;
            padding: 0 18px;
        }

        .input-wrapper input,
        .input-wrapper select {
            width: 100%;
            height: 100%;
            border: none;
            background: transparent;
            outline: none;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Manrope', sans-serif;
        }

        .input-wrapper input::placeholder,
        .input-wrapper select {
            color: var(--text-dark);
        }

        .select-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .select-wrapper select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 30px;
        }

        .select-arrow {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .btn-check-location {
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--primary-blue);
            color: var(--white);
            height: 46px;
            gap: 8px;
            padding: 18px 20px;
            font-size: 16px;
        }

        .map-title {
            color: var(--dark-blue);
            font-size: 48px;
            font-weight: 700;
            line-height: 40px;
            letter-spacing: 4.32px;
            text-align: center;
            margin-bottom: 64px;
        }

        .map-image-container {
            background: radial-gradient(173.07% 205.27% at 50% 50%, #ffffff 32.81%, #f8fdff 97.64%);
            border-radius: 28px;
            box-shadow: 3.12px 9.37px 21.85px 0px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .map-image-container iframe {
            border-radius: 12px;
            width: 100%;
            height: 500px;
            ;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: 24px;
            box-shadow: 3.12px 9.37px 21.85px 0px rgba(0, 0, 0, 0.06);
            width: 100%;
            height: 128px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            border: 2px solid var(--primary-blue);
        }

        .stat-value {
            font-size: 40px;
            font-weight: 600;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-number {
            color: var(--dark-blue);
        }

        .stat-number-alt {
            color: #0179b4;
            font-size: 40px;
            font-weight: 600;
            line-height: 1;
        }

        .stat-label {
            color: #757575;
            font-size: 16px;
            font-weight: 600;
        }

        .site-footer {
            background-color: var(--bg-light-blue);
            padding: 72px 0 40px;
        }

        .footer-logo {
            width: 223px;
            margin-bottom: 24px;
        }

        .footer-brand p {
            font-size: 16px;
            font-weight: 500;
            line-height: 24px;
            color: var(--text-light);
        }

        .footer-links h4 {
            color: var(--primary-blue);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer-links ul {
            padding-left: 0;
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 16px;
        }

        .footer-links ul li:last-child {
            margin-bottom: 0;
        }

        .footer-links a {
            color: var(--text-light);
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--dark-blue);
            text-decoration: none;
        }

        .footer-divider {
            border: none;
            height: 2px;
            background-color: #b6e6ff;
            margin: 0;
        }

        .social-links img {
            width: 32px;
            height: 32px;
        }

        .copyright {
            color: #b0b0b0;
            font-size: 16px;
            font-weight: 600;
        }

        /* Tambahan style untuk modal */
        #locationModal .modal-dialog {
            max-width: 60%;
        }

        #locationModal .canvas-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #locationModal .info-item {
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        @media (max-width: 768px) {
            #locationModal .modal-dialog {
                max-width: 95%;
                margin: 0.5rem auto;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: var(--white);
                padding: 20px;
                border-radius: 12px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                margin-top: 15px;
            }

            .btn-login {
                margin-top: 10px;
                width: 100%;
            }

            .navbar-nav .nav-link::after {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 50vh;
            }

            .info-title {
                font-size: 40px;
                line-height: 1.2;
            }

            .location-title,
            .map-title {
                font-size: 32px;
                margin-bottom: 40px;
            }

            .location-card {
                padding: 20px;
            }

            .btn-check-location {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .info-title {
                font-size: 32px;
            }

            .location-title,
            .map-title {
                font-size: 28px;
                letter-spacing: 2px;
            }

            .footer-main {
                text-align: center;
            }

            .footer-links {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" alt="Jasamarga Logo"
                    style="width: 223px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#info">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location-check">Cek SFO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map">Lokasi</a>
                    </li>
                </ul>
                <a href="{{ url('/login') }}" class="btn btn-login">Login</a>
            </div>
        </div>
    </nav>

    <section id="hero" class="hero-section">
        <div class="hero-background">
            <div class="hero-bg-image-wrapper">
                <img src="{{ asset('images/2c2f7e3fbee004f8b1282567157469b3243c7d7c.png') }}"
                    alt="Toll road aerial view" class="hero-bg-image">
            </div>
            <img src="{{ asset('images/314_724.svg') }}" alt="" class="hero-vector-overlay">
        </div>
    </section>

    <section id="info" class="info-section py-5">
        <div class="container">
            <h1 class="info-title text-center">
                TOL <span class="gradient-text">SURABAYA - GEMPOL</span>
            </h1>
            <p class="info-description text-center">
                Jalan Tol Surabaya–Gempol atau Jalan Tol Surgem adalah <a
                    href="https://id.wikipedia.org/wiki/Jalan_tol">jalan tol</a> yang membentang sepanjang 45 kilometer
                yang menghubungkan antara <a href="#">Kota Surabaya</a> dengan daerah <a
                    href="#">Gempol</a>, <a href="#">Kabupaten Pasuruan</a>, <a href="#">Jawa
                    Timur</a>. Jalan tol ini terhubung dengan <a href="#">Jalan Tol Surabaya-Mojokerto</a> di
                sebelah barat, <a href="#">Jalan Tol Surabaya-Gresik</a> di sebelah barat laut, <a
                    href="#">Jalan Tol Waru-Juanda</a> di sebelah timur, serta <a href="#">Jalan Tol
                    Gempol-Pandaan</a> dan <a href="#">Jalan Tol Gempol-Pasuruan</a> di sebelah selatan. Jalan tol
                ini melintasi Kota Surabaya, <a href="#">Kabupaten Sidoarjo</a>, dan Kabupaten Pasuruan. Jalan Tol
                Surabaya–Gempol ruas Waru–Gempol merupakan bagian dari <a href="#">Jalan Tol Trans Jawa</a> yang
                menghubungkan <a href="#">Pelabuhan Merak</a> di <a href="#">Kota Cilegon</a>, <a
                    href="#">Banten</a> dengan <a href="#">Pelabuhan Ketapang</a> di <a
                    href="#">Kabupaten Banyuwangi</a>, Jawa Timur. Jalan tol ini juga menjadi akses utama jalur
                Surabaya-<a href="#">Malang</a> dan Surabaya-<a href="#">Pasuruan</a> yang merupakan salah
                satu daerah industri utama di Jawa Timur. Jalan tol ini mulai beroperasi sejak 26 Juli 1986 yang
                merupakan jalan tol tertua dan tersibuk di wilayah Indonesia bagian timur.
            </p>
        </div>
    </section>

    <section id="location-check" class="location-check-section py-5">
        <div class="container">
            <div class="location-card">
                <h2 class="location-title">CEK LOKASI SFO</h2>
                <form class="location-form row g-3 d-flex justify-content-center">
                    <div class="form-group col-md-3">
                        <div class="form-group-header">
                            <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                class="form-icon">
                            <label>Lokasi Awal</label>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Masukan Lokasi Awal">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-group-header">
                            <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                class="form-icon">
                            <label>Lokasi Sampai</label>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Masukan Lokasi Akhir">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-group-header">
                            <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}"
                                alt="" class="form-icon">
                            <label>Pilih Tahun</label>
                        </div>
                        <div class="input-wrapper select-wrapper">
                            <select id="tahun" name="tahun">
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-group-header">
                            <img src="{{ asset('images/314_740.svg') }}" alt="" class="form-icon">
                            <label>Posisi</label>
                        </div>
                        <div class="input-wrapper select-wrapper">
                            <select>
                                <option>Pilih Posisi Jalan</option>
                            </select>
                            <img src="{{ asset('images/I314_744_61_43.svg') }}" alt="dropdown arrow"
                                class="select-arrow">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-check-location w-100">
                            Cek Lokasi
                            <img src="{{ asset('images/314_747.svg') }}" alt="">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold text-center" id="locationModalLabel">LOCATION SFO</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <section id="map" class="map-section py-5">
        <div class="container">
            <h2 class="map-title">MAP TOL SURABAYA-GEMPOL</h2>
            <div class="map-image-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39883.042034341364!2d112.68141917101593!3d-7.365164020925569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fc7337a6a6d7%3A0x68c18453567d36f!2sJl.%20Tol%20Surabaya%20-%20Gempol%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1755215273204!5m2!1sid!2sid"
                    width="1200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section id="stats" class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <p class="stat-value"><span class="stat-number">45</span> km</p>
                        <p class="stat-label">Panjang Ruas Tol</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <p class="stat-value"><span class="stat-number">18</span> GATE</p>
                        <p class="stat-label">Gerbang Tol</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <p class="stat-value"><span class="stat-number-alt">2</span></p>
                        <p class="stat-label">Rest Area</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="site-footer">
        <div class="container">
            <div class="row footer-main">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}"
                            alt="Jasamarga Logo" class="footer-logo">
                        <p>Experience personalized medical care from the comfort of your home.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Getting Started</a></li>
                            <li><a href="#">FAQS</a></li>
                            <li><a href="#">Help Articles</a></li>
                            <li><a href="#">Report an issue</a></li>
                            <li><a href="#">Contact Help Desk</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="#">Booking appointments</a></li>
                            <li><a href="#">Online consultations</a></li>
                            <li><a href="#">Prescriptions</a></li>
                            <li><a href="#">Medicine Refills</a></li>
                            <li><a href="#">Medical Notes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="footer-links">
                        <h4>Legal</h4>
                        <ul>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookie Notice</a></li>
                            <li><a href="#">Cookie Preferences</a></li>
                            <li><a href="#">Trust Center</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row flex-lg-row-reverse justify-content-between footer-bottom">
                <div class="col-md-6 order-md-2 justify-content-start text-md-start text-center mb-3 mb-md-0">
                    <div class="social-links gap-3 mt-md-2 mt-3">
                        <a href="#"><img src="{{ asset('images/314_805.svg') }}" alt="Facebook"></a>
                        <a href="#"><img src="{{ asset('images/314_807.svg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('images/314_811.svg') }}" alt="LinkedIn"></a>
                        <a href="#"><img src="{{ asset('images/314_809.svg') }}" alt="YouTube"></a>
                    </div>
                </div>
                <div class="col-md-6 order-md-1 text-md-end text-center mt-2">
                    <p class="copyright">HealNet 2024 © All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangani submit form
            const locationForm = document.querySelector('.location-form');
            locationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('locationModal'));
                modal.show();

                // Muat konten SFO ke dalam modal
                loadSFOContent();
            });

            // Fungsi untuk memuat konten SFO
            function loadSFOContent() {
                const modalBody = document.getElementById('modalBodyContent');

                // Tampilkan loading state
                modalBody.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data SFO...</p>
                </div>
            `;

                // Simulasi pengambilan data (dalam implementasi nyata, ini akan berupa AJAX request)
                setTimeout(() => {
                    // Konten dari detail.blade.php
                    modalBody.innerHTML = `
                    <div class="container-fluid">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="canvas-wrapper" style="width: 100%; overflow-x: auto;">
                                        <canvas id="sfoCanvas" width="900" height="400"></canvas>
                                    </div>
                                </div>

                                <div class="keterangan-sfo w-100 bg-light p-3 rounded">
                                    <h4 class="text-primary mb-3">Keterangan Data SFO</h4>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Lokasi SFO:</span>
                                                <span id="lokasi-sfo">Jakarta - Surabaya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Posisi Jalur:</span>
                                                <span id="posisi-jalur">KM 25+200 - KM 25+800</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Panjang:</span>
                                                <span id="panjang">600 m</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Lebar:</span>
                                                <span id="lebar">8 m</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Tebal:</span>
                                                <span id="tebal">25 cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Luas:</span>
                                                <span id="luas">4800 m²</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Tanggal SFO:</span>
                                                <span id="tanggal-sfo">15-08-2025</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-item bg-white p-2 rounded mb-2">
                                                <span class="fw-bold text-secondary">Keterangan:</span>
                                                <span id="keterangan">Perbaikan jalur arah timur, penggantian beton lama dengan rigid
                                                    pavement.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                    // Inisialisasi canvas setelah konten dimuat
                    initSfoCanvas();
                }, 1000);
            }

            // Fungsi untuk menggambar canvas SFO
            function initSfoCanvas() {
                const canvas = document.getElementById("sfoCanvas");
                if (!canvas) return;

                const ctx = canvas.getContext("2d");
                const selectedJalur = 1; // Default jalur

                // Dummy data
                const dataSFO = [{
                        km_awal: 0,
                        km_akhir: 1,
                        warna: "blue",
                        tahun: "2022"
                    },
                    {
                        km_awal: 1,
                        km_akhir: 2,
                        warna: "green",
                        tahun: "2023"
                    },
                    {
                        km_awal: 2,
                        km_akhir: 3,
                        warna: "blue",
                        tahun: "2024"
                    },
                    {
                        km_awal: 3,
                        km_akhir: 4,
                        warna: "blue",
                        tahun: "2025"
                    },
                ];

                // Posisi Y untuk tiap jalur
                const jalurY = {
                    1: 100,
                    2: 230,
                    3: 360
                };
                const kmStep = 200; // Lebar per KM

                function drawArrow(x, y) {
                    ctx.beginPath();
                    ctx.moveTo(x, y);
                    ctx.lineTo(x, y - 25);
                    ctx.lineTo(x - 5, y - 20);
                    ctx.moveTo(x, y - 25);
                    ctx.lineTo(x + 5, y - 20);
                    ctx.strokeStyle = "#000";
                    ctx.stroke();
                }

                function drawTrack(jalur) {
                    let y = jalurY[jalur];

                    // Garis dasar jalur
                    ctx.fillStyle = (jalur == selectedJalur) ? "#e0e0e0" : "#f5f5f5";
                    ctx.fillRect(50, y, 800, 40);

                    // Blok-blok data
                    dataSFO.forEach(item => {
                        let startX = 50 + item.km_awal * kmStep;
                        let width = (item.km_akhir - item.km_awal) * kmStep;

                        ctx.fillStyle = (jalur == selectedJalur) ? item.warna : "#cfcfcf";
                        ctx.fillRect(startX, y, width, 40);

                        // Tahun label
                        ctx.fillStyle = "#000";
                        ctx.font = "14px Arial";
                        ctx.fillText(item.tahun, startX + width / 2 - 15, y + 65);

                        // Panah
                        drawArrow(startX + width / 2, y);
                    });

                    // KM label di atas jalur
                    ctx.fillStyle = "#000";
                    ctx.font = "14px Arial";
                    for (let km = 0; km <= 4; km++) {
                        ctx.fillText("KM " + km, 50 + km * kmStep, y - 15);
                    }
                }

                // Gambar semua jalur
                drawTrack(1);
                drawTrack(2);
                drawTrack(3);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const navbarCollapse = document.querySelector('.navbar-collapse');
                        if (navbarCollapse.classList.contains('show')) {
                            const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                            bsCollapse.hide();
                        }

                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('section[id]');
                const scrollPosition = window.scrollY + 100;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');

                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop +
                        sectionHeight) {
                        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                            link.classList.remove('active');
                        });

                        const activeLink = document.querySelector(
                            `.navbar-nav .nav-link[href="#${sectionId}"]`);
                        if (activeLink) {
                            activeLink.classList.add('active');
                        }
                    }
                });

                if (window.scrollY > 50) {
                    document.querySelector('.navbar').classList.add('scrolled');
                } else {
                    document.querySelector('.navbar').classList.remove('scrolled');
                }
            });

            document.querySelector('.navbar-nav .nav-link[href="#hero"]').classList.add('active');
        });
    </script>
</body>

</html>
