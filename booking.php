<?php
session_start(); // Start the session

// Enable error reporting for debugging (useful for development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php'; // Include the database connection file

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php?pesan=harus_login");
    exit();
}

// Retrieve services from the database to display in the dropdown
$services_result = mysqli_query($koneksi, "SELECT id, nama_layanan FROM services ORDER BY nama_layanan ASC");

// Check if session variables are set, if not, initialize them to avoid warnings
if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = ''; // Default value if not set
}
if (!isset($_SESSION['telepon'])) {
    $_SESSION['telepon'] = ''; // Default value if not set
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pemesanan Jasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: var(--light-color);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Formulir Pemesanan Jasa</h2>
                    <p class="text-muted">Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</p>
                    <p class="text-success">Data Nama Lengkap dan email Anda telah otomatis terisi dari informasi login.</p>
                </div>

<form action="proses_booking.php" method="POST">
    <div class="row g-3">

        <!-- Nama Lengkap (Read Only) -->
        <div class="col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>" readonly>
        </div>

        <!-- Email (Read Only) -->
        <div class="col-md-6">
            <label class="form-label">Alamat Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
        </div>

        <!-- Telepon (Input jika kosong) -->
        <div class="col-md-6">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="telepon" value="<?php echo htmlspecialchars($_SESSION['telepon']); ?>" required>
        </div>

        <!-- Pilih Jasa -->
        <div class="col-md-6">
            <label class="form-label">Pilih Jasa</label>
            <select name="service_id" class="form-select" required>
                <option disabled selected value="">Pilih...</option>
                <?php while ($service = mysqli_fetch_assoc($services_result)): ?>
                    <option value="<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['nama_layanan']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Tanggal Booking -->
        <div class="col-md-6">
            <label class="form-label">Tanggal Acara / Project</label>
            <input type="date" class="form-control" name="tanggal_booking" required>
        </div>

        <!-- Deskripsi -->
        <div class="col-12">
            <label class="form-label">Deskripsi Kebutuhan</label>
            <textarea class="form-control" name="deskripsi" rows="5" placeholder="Jelaskan secara singkat tentang proyek Anda..." required></textarea>
        </div>

        <!-- Tombol -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Kirim Permintaan</button>
            <a href="index.php" class="btn btn-secondary btn-lg ms-2">Batal</a>
        </div>

    </div>
</form>
            </div>
        </div>
    </div>
</body>
</html>
