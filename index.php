<?php
// Contoh penggunaan session untuk login check
session_start();
// Misal: $_SESSION['logged_in'] = true; diatur saat login berhasil
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mumtaz Film - Professional Videography & Photography</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <style>
        /* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

:root {
    --primary-color: #0d6efd; /* Biru Bootstrap */
    --dark-color: #1a1a1a;
    --light-color: #f8f9fa;
    --font-family: 'Poppins', sans-serif;
    --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

body {
    font-family: var(--font-family);
    line-height: 1.7;
    color: #444;
    background-color: #fff;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
    color: #333;
}

/* --- Navbar --- */
.navbar {
    transition: background-color 0.4s ease, padding 0.4s ease;
    padding: 1rem 0;
    background-color: transparent;
}
.navbar.scrolled {
    background-color: rgba(26, 26, 26, 0.9);
    backdrop-filter: blur(5px);
    padding: 0.5rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.navbar-brand {
    font-size: 1.5rem;
}
.navbar .nav-link {
    transition: color 0.3s ease;
    font-weight: 400;
}
.navbar .nav-link.active,
.navbar .nav-link:hover {
    color: var(--primary-color) !important;
}

/* --- Hero Section --- */
.hero-section {
    position: relative;
    height: 120vh;
    overflow: hidden;
    padding-top: 80px; /* Menurunkan konten sedikit */
    display: flex;
    align-items: center;
    justify-content: center;
}
.video-bg-blurry {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -2;
    transform: translateX(-50%) translateY(-50%) scale(1.1);
    filter: blur(20px);
}
.main-video-wrapper {
    display: inline-block;
    padding: 10px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
}
.video-bg-clear {
    width: 100%;
    max-width: 280px; /* Ukuran video portrait di tengah */
    height: auto;
    border-radius: 15px;
    z-index: -1;
}
.hero-title {
    color: #fff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}
.hero-subtitle {
    color: #e0e0e0;
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
}


/* --- Layanan Section --- */
.service-card-image {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border-radius: 15px;
    background-size: cover;
    background-position: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-height: 350px;
    border: none;
}
.service-card-image:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}
.service-card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.1));
    transition: background 0.3s ease;
}
.service-card-image:hover::before {
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.3));
}
.service-card-content {
    position: relative;
    z-index: 2;
    padding: 1.5rem;
    transition: transform 0.3s ease;
}
.service-card-image:hover .service-card-content {
    transform: translateY(-5px);
}
.service-card-image .icon-circle {
    width: 80px;
    height: 80px;
    background-color: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease;
}
.service-card-image h4, .service-card-image p {
    color: white;
}

/* --- Portfolio --- */
.portfolio-wrap {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: var(--box-shadow);
    background: #000;
}
.portfolio-wrap img {
    transition: transform 0.4s ease, opacity 0.4s ease;
}
.portfolio-wrap:hover img {
    transform: scale(1.1);
    opacity: 0.4;
}
.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.portfolio-wrap:hover .portfolio-overlay {
    opacity: 1;
}
.portfolio-info h4 {
    color: white;
    font-weight: bold;
}
.portfolio-info p {
    color: #ddd;
}
.portfolio-info::after {
    content: '\f00e'; /* Ikon search/plus dari Font Awesome */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    font-size: 2rem;
    margin-top: 1rem;
    display: block;
}

/* --- Project Video Section (Updated) --- */
.project-video-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 9 / 16; /* Memaksa bentuk portrait */
    border-radius: 20px;
    overflow: hidden; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    background: #000; /* Latar belakang jika video gagal load */
}
.project-video-wrapper .video-bg-blurry.project {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Penting agar video menutupi area */
    filter: blur(15px) brightness(0.6);
    transform: scale(1.05); /* Sedikit zoom untuk menyembunyikan tepi */
    z-index: 1;
}
.project-video-wrapper .video-bg-clear.project {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Penting agar video pas di dalam wrapper */
    padding: 10px; /* Jarak antara video utama dengan tepi */
    border-radius: 20px; /* Menyesuaikan radius dengan wrapper */
}


/* --- Klien Section --- */
.client-logo img {
    max-height: 50px;
    width: auto;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease-in-out;
}
.client-logo:hover img {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
}

/* --- Animasi --- */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}
.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-film"></i> Mumtaz Film
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#clients">Klien</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary btn-sm px-3" href="booking.php">Pesan Sekarang</a></li>
                </ul>
                <ul class="navbar-nav ms-lg-3">
                     <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="hero" class="hero-section d-flex align-items-center text-center">
        <video autoplay muted loop playsinline class="video-bg-blurry">
            <source src="assets/video/video5.mp4" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
        
        <div class="container position-relative">
            <div class="main-video-wrapper fade-in">
                 <video autoplay muted loop playsinline class="video-bg-clear">
                    <source src="assets/video/video5.mp4" type="video/mp4">
                </video>
            </div>
            
            <h1 class="display-4 fw-bold fade-in mt-4 hero-title">Wujudkan Ide Kreatif Anda</h1>
            <p class="lead my-3 fade-in hero-subtitle">Layanan profesional untuk Videografi dan Fotografi.</p>
            <a href="booking.php" class="btn btn-primary btn-lg mt-3 fade-in">
                <i class="fas fa-calendar-check"></i> Booking Jadwal
            </a>
            <a href="#portfolio" class="btn btn-outline-light btn-lg mt-3 fade-in">
                <i class="fas fa-briefcase"></i> Lihat Karya Kami
            </a>
        </div>
    </header>

    <section id="layanan" class="py-5">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="fw-bold">Layanan Unggulan Kami</h2>
                <p class="text-muted">Pilih layanan yang sesuai dengan kebutuhan Anda untuk memulai.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-lg-4 col-md-6 fade-in">
                    <a href="#" onclick="checkLoginAndRedirect('Desain Grafis'); return false;" class="card service-card-image h-100 text-white text-decoration-none" style="background-image: url('assets/img/galeri7.jpg');">
                        <div class="service-card-content">
                            <div class="icon-circle mb-3"><i class="fas fa-pencil-ruler fa-2x"></i></div>
                            <h4 class="card-title">Desain Grafis</h4>
                            <p class="card-text">Logo, branding, brosur, & media sosial.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 fade-in">
                     <a href="#" onclick="checkLoginAndRedirect('Fotografi'); return false;" class="card service-card-image h-100 text-white text-decoration-none" style="background-image: url('assets/img/galeri8.jpg');">
                        <div class="service-card-content">
                            <div class="icon-circle mb-3"><i class="fas fa-camera-retro fa-2x"></i></div>
                            <h4 class="card-title">Fotografi</h4>
                            <p class="card-text">Produk, event, portrait, & wedding.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 fade-in">
                    <a href="#" onclick="checkLoginAndRedirect('Videografi'); return false;" class="card service-card-image h-100 text-white text-decoration-none" style="background-image: url('assets/img/galeri6.jpg');">
                        <div class="service-card-content">
                            <div class="icon-circle mb-3"><i class="fas fa-video fa-2x"></i></div>
                            <h4 class="card-title">Videografi</h4>
                            <p class="card-text">Company profile, iklan, & dokumentasi.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="fw-bold">Portfolio Kami</h2>
                <p class="text-muted">Beberapa karya terbaik yang pernah kami hasilkan.</p>
            </div>
            
            <div class="row g-4 portfolio-container">
                <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri2.jpg" class="img-fluid" alt="Portfolio 2">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 2</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri3.jpg" class="img-fluid" alt="Portfolio 3">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 3</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri4.jpg" class="img-fluid" alt="Portfolio 4">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 4</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri5.jpg" class="img-fluid" alt="Portfolio 5">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 5</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri9.jpg" class="img-fluid" alt="Portfolio 6">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 6</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-4 portfolio-item fade-in">
                    <div class="portfolio-wrap">
                        <img src="assets/img/galeri1.jpg" class="img-fluid" alt="Portfolio 1">
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h4>Project 1</h4>
                                <p>Deskripsi Singkat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="project-video" class="py-5">
    <div class="container">
        ...
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10"> <div class="row g-4 justify-content-center">
                    <div class="col-lg-4 col-md-6 fade-in">
                        <div class="project-video-wrapper">
                            <video autoplay muted loop playsinline class="video-bg-blurry project">
                                <source src="assets/video/video5.mp4" type="video/mp4">
                            </video>
                            <video autoplay muted loop playsinline class="video-bg-clear project">
                                <source src="assets/video/video5.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 fade-in">
                        <div class="project-video-wrapper">
                            <video autoplay muted loop playsinline class="video-bg-blurry project">
                                <source src="assets/video/video1.mp4" type="video/mp4">
                            </video>
                            <video autoplay muted loop playsinline class="video-bg-clear project">
                                <source src="assets/video/video1.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 fade-in">
                         <div class="project-video-wrapper">
                            <video autoplay muted loop playsinline class="video-bg-blurry project">
                                <source src="assets/video/video2.mp4" type="video/mp4">
                            </video>
                            <video autoplay muted loop playsinline class="video-bg-clear project">
                                <source src="assets/video/video2.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div> </div>
    </div>
</section>

    <section id="clients" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="fw-bold">Telah Dipercaya Oleh</h2>
                <p class="text-muted">Kami bangga telah bekerjasama dengan berbagai perusahaan ternama.</p>
            </div>
            <div class="row g-5 align-items-center justify-content-center text-center">
                <div class="col-6 col-md-4 col-lg-2 fade-in client-logo">
                    <img src="assets/img/clients/sisi.png" class="img-fluid" alt="PT Sistem Informatika Semen Indonesia">
                </div>
                <div class="col-6 col-md-4 col-lg-2 fade-in client-logo">
                    <img src="assets/img/clients/vidio.png" class="img-fluid" alt="Vidio.com">
                </div>
                <div class="col-6 col-md-4 col-lg-2 fade-in client-logo">
                    <img src="assets/img/clients/kominfo.png" class="img-fluid" alt="Kominfo Yogyakarta">
                </div>
                <div class="col-6 col-md-4 col-lg-2 fade-in client-logo">
                    <img src="assets/img/clients/rans.png" class="img-fluid" alt="Rans Entertainment">
                </div>
            </div>
        </div>
    </section>
    
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-4 col-lg-4 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-primary">Mumtaz Film</h5>
                    <p>Solusi kreatif untuk kebutuhan videografi dan fotografi Anda. Kami berkomitmen memberikan hasil terbaik dan pelayanan profesional.</p>
                </div>
                <div class="col-md-2 col-lg-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold">Navigasi</h5>
                    <p><a href="#layanan" class="text-white">Layanan</a></p>
                    <p><a href="#portfolio" class="text-white">Portfolio</a></p>
                    <p><a href="booking.html" class="text-white">Booking</a></p>
                </div>
                <div class="col-md-4 col-lg-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold">Kontak</h5>
                    <p><i class="fas fa-home me-3"></i> Yogyakarta, Indonesia</p>
                    <p><i class="fas fa-envelope me-3"></i> info@mumtazfilm.com</p>
                    <p><i class="fas fa-phone me-3"></i> +62 812 3456 7890</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="d-flex justify-content-between align-items-center">
                <small>&copy; 2025 Mumtaz Film. All rights reserved.</small>
                <div>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>