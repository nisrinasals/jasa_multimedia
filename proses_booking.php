<?php
session_start(); // Start the session
include 'koneksi.php'; // Include the database connection file

// Pastikan user sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php?pesan=harus_login");
    exit();
}

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$telepon = $_POST['telepon']; // Telepon yang diinput oleh pengguna
$service_id = $_POST['service_id'];
$deskripsi = $_POST['deskripsi'];
$tanggal_booking = $_POST['tanggal_booking'];

// Tentukan status, misalnya 'Pending'
$status = 'Pending';

// Ambil data user_id dari session
$user_id = $_SESSION['user_id'];

// Ambil email berdasarkan user_id dari tabel users
$query_user = "SELECT email FROM users WHERE id = ?";
$stmt_user = mysqli_prepare($koneksi, $query_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

// Jika data ditemukan, ambil email
if ($user_data = $result_user->fetch_assoc()) {
    $email = $user_data['email'];
} else {
    // Jika data tidak ditemukan, beri penanganan lainnya (misalnya beri nilai default)
    $email = '';
}

$stmt_user->close();

// Ambil nama layanan berdasarkan service_id yang dipilih
$query_service = "SELECT nama_layanan FROM services WHERE id = ?";
$stmt_service = mysqli_prepare($koneksi, $query_service);
$stmt_service->bind_param("i", $service_id);
$stmt_service->execute();
$result_service = $stmt_service->get_result();

// Jika data ditemukan, ambil nama layanan
if ($service_data = $result_service->fetch_assoc()) {
    $jasa = $service_data['nama_layanan'];
} else {
    // Jika data tidak ditemukan, beri pesan atau penanganan lainnya
    $jasa = '';
}

$stmt_service->close();

// Masukkan data ke dalam tabel bookings (termasuk jasa)
// Masukkan data ke dalam tabel bookings (termasuk jasa)
$query = "INSERT INTO bookings (user_id, nama_lengkap, email, telepon, service_id, jasa, deskripsi, tanggal_booking, status) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);

// Bind parameter dengan data yang diinput oleh pengguna
$stmt->bind_param("issssssss", $user_id, $nama_lengkap, $email, $telepon, $service_id, $jasa, $deskripsi, $tanggal_booking, $status);

// Eksekusi query
if ($stmt->execute()) {
    header("Location: success_page.php?status=success");
} else {
    header("Location: booking.php?status=error&message=" . urlencode("Terjadi kesalahan saat memproses permintaan Anda."));
}

$stmt->close();
$koneksi->close();
?>
