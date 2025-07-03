<?php
session_start();

// Dummy credentials for demonstration
$admin_username = 'admin';
$admin_password = 'admin123'; // Gantilah dengan hash password yang lebih aman

// Ambil data dari form
$username = $_POST['admin_username'];
$password = $_POST['admin_password'];

// Cek kredensial
if ($username === $admin_username && $password === $admin_password) {
    // Set session untuk login
    $_SESSION['admin_logged_in'] = true;
    header("Location: adminpanel.php");
    exit();
} else {
    // Redirect kembali ke halaman login dengan error
    $_SESSION['login_error'] = 'Username atau password salah!';
    header("Location: admin_login.php");
    exit();
}
?>