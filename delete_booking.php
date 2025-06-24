<?php
session_start();
include 'koneksi.php';

// Pastikan admin sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

// Ambil ID booking dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus booking berdasarkan ID
    $query = "DELETE FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    $stmt->bind_param("i", $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman dashboard dengan pesan sukses
        header("Location: admin_dashboard.php?status=deleted");
        exit();
    } else {
        // Jika gagal, beri pesan error
        echo "Terjadi kesalahan saat menghapus pemesanan.";
    }

    $stmt->close();
} else {
    // Jika tidak ada ID yang dikirimkan, arahkan kembali ke dashboard
    header("Location: admin_dashboard.php");
    exit();
}

mysqli_close($koneksi);
?>
