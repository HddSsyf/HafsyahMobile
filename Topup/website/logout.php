<?php
session_start();
session_unset(); // Hapus semua sesi
session_destroy(); // Hapus sesi
header("Location: admin_login.php"); // Arahkan kembali ke halaman login admin
exit();
?>