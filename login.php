<?php
session_start(); // Start the session

// Enable error reporting for debugging (TURN OFF IN PRODUCTION)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php'; // Include the database connection file

// Ensure the request is a POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize the data from the form
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Password taken as it is

    // Basic validation: Ensure email and password are not empty
    if (empty($email) || empty($password)) {
        header("Location: login.html?status=gagal&pesan=" . urlencode("Email atau password tidak boleh kosong."));
        exit();
    }

    // Use Prepared Statement to search for user by email
    // Only select necessary columns (email, password, etc.)
    $query = "SELECT id, nama_lengkap, email, password, role FROM users WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt === false) {
        // Log error for debugging internally, don't display to the user
        error_log("Prepare statement failed in login.php: " . mysqli_error($koneksi));
        header("Location: login.html?status=gagal&pesan=" . urlencode("Terjadi kesalahan sistem. Silakan coba lagi nanti."));
        exit();
    }

    // Bind the parameter email to the statement
    mysqli_stmt_bind_param($stmt, "s", $email); // 's' means the parameter is a string

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the query result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $user['password'])) { // Use password_verify to validate the hashed password
            // Password is correct, store user data in the session
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            // Close the statement and connection before redirecting
            mysqli_stmt_close($stmt);
            mysqli_close($koneksi);

            // Redirect based on role
            if ($user['role'] == 'admin') {
                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
            } else {
                // Redirect to user dashboard
                header("Location: user_dashboard.php");
            }
            exit(); // End the script execution after the header redirect
        } else {
            // Password does not match
            header("Location: login.html?status=gagal&pesan=" . urlencode("Email atau password salah."));
            exit();
        }
    } else {
        // User not found
        header("Location: login.html?status=gagal&pesan=" . urlencode("Email atau password salah."));
        exit();
    }

    // If the statement is prepared successfully, close the statement and connection
    if (isset($stmt) && $stmt !== false) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($koneksi);

} else {
    // If the page is accessed directly without submitting the form (not a POST request)
    header("Location: login.html");
    exit();
}
?>
