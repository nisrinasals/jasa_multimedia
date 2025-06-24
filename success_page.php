<?php
session_start();
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php?pesan=harus_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: var(--light-color);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Booking Sukses!</h2>
                    <p class="text-muted">Terima kasih, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>! Pemesanan Anda telah berhasil.</p>
                    <p class="text-success">Kami akan segera menghubungi Anda untuk konfirmasi lebih lanjut.</p>
                    <a href="user_dashboard.php" class="btn btn-primary btn-lg mt-3"><i class="fas fa-home"></i> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
