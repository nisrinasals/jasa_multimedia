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
} else {
    // Jika tidak ada ID yang dikirimkan, arahkan ke halaman dashboard
    header("Location: admin_dashboard.php");
    exit();
}

// Ambil data pemesanan berdasarkan ID
$query = "SELECT * FROM bookings WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Jika data ditemukan, tampilkan form untuk update status
if ($row = $result->fetch_assoc()) {
    $nama_lengkap = $row['nama_lengkap'];
    $telepon = $row['telepon'];
    $service_id = $row['service_id'];
    $jasa = $row['jasa'];
    $status = $row['status']; // Status saat ini
} else {
    // Jika tidak ditemukan, arahkan kembali ke dashboard
    header("Location: admin_dashboard.php");
    exit();
}

$stmt->close();

// Ambil data layanan dari tabel services untuk dropdown
$query_services = "SELECT * FROM services";
$result_services = mysqli_query($koneksi, $query_services);

// Proses Update Status
if (isset($_POST['update_status'])) {
    $new_status = $_POST['status']; // Status baru yang dipilih oleh admin
    $new_service_id = $_POST['service_id']; // Jasa yang dipilih

    // Ambil nama jasa berdasarkan service_id yang dipilih
    $query_service = "SELECT nama_layanan FROM services WHERE id = ?";
    $stmt_service = mysqli_prepare($koneksi, $query_service);
    $stmt_service->bind_param("i", $new_service_id);
    $stmt_service->execute();
    $result_service = $stmt_service->get_result();
    $service_data = $result_service->fetch_assoc();
    $new_jasa = $service_data['nama_layanan'];

    // Update status dan jasa di database
    $update_query = "UPDATE bookings SET status = ?, service_id = ?, jasa = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($koneksi, $update_query);
    $stmt_update->bind_param("sisi", $new_status, $new_service_id, $new_jasa, $id);

    if ($stmt_update->execute()) {
        // Jika berhasil, arahkan ke halaman dashboard dengan pesan sukses
        header("Location: admin_dashboard.php?status=updated");
        exit();
    } else {
        // Jika gagal, beri pesan error
        $error_message = "Terjadi kesalahan saat memperbarui status.";
    }

    $stmt_update->close();
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Update Status Pemesanan</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="update_status.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" value="<?php echo htmlspecialchars($nama_lengkap); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="telepon" value="<?php echo htmlspecialchars($telepon); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="jasa" class="form-label">Jasa</label>
                <select name="service_id" id="jasa" class="form-select" required>
                    <?php while ($service = mysqli_fetch_assoc($result_services)): ?>
                        <option value="<?php echo $service['id']; ?>" <?php echo ($service['id'] == $service_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($service['nama_layanan']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Pemesanan</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="In Progress" <?php echo ($status == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo ($status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo ($status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="update_status" class="btn btn-primary btn-lg">Update Status</button>
                <a href="admin_dashboard.php" class="btn btn-secondary btn-lg ms-2">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
