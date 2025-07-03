<?php
session_start();

// Simulasi proses login Garena. Anda perlu mengganti ini dengan proses login sebenarnya yang disediakan oleh Garena.
$login_successful = true;

if ($login_successful) {
    // Setelah berhasil login, arahkan ke halaman utama
    header('Location: index.php');
    exit;
} else {
    $_SESSION['error'] = 'Login dengan Garena gagal. Silakan coba lagi.';
    header('Location: login.php');
    exit;
}
?>
