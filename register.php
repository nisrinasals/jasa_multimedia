<?php
// proses_register.php (Versi Baru & Aman)

include 'koneksi.php';

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi dasar
if (empty($nama_lengkap) || empty($email) || empty($password)) {
    die("Error: Semua kolom wajib diisi.");
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Gunakan Prepared Statements untuk keamanan
$stmt = $koneksi->prepare("INSERT INTO users (nama_lengkap, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama_lengkap, $email, $hashed_password);

// Eksekusi statement
if ($stmt->execute()) {
    // Set session variables after successful registration
    session_start(); // Make sure the session is started
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['user_id'] = $koneksi->insert_id; // Inserted user ID
    $_SESSION['nama_lengkap'] = $nama_lengkap;
    $_SESSION['email'] = $email; // You can add email and other fields here
    $_SESSION['role'] = 'user'; // Assuming user role after registration

    // Redirect to dashboard or login page
    header("Location: login.html?status=registrasi_sukses");
    exit();
} else {
    // Cek jika ada error duplikat email atau username
    if ($koneksi->errno == 1062) {
        die("Error: Email sudah terdaftar.");
    } else {
        die("Error saat registrasi: " . $stmt->error);
    }
}

$stmt->close();
$koneksi->close();
?>
