<?php
$host = "localhost"; // Sesuaikan dengan host database Anda
$username = "root";  // Sesuaikan dengan username database Anda
$password = "";      // Sesuaikan dengan password database Anda
$dbname = "multimedia"; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
