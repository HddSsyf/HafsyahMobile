<?php
session_start(); // Pindahkan ini ke baris paling atas

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitasi input dari pengguna
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password_input = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // Gunakan nama variabel berbeda untuk input password

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password_input)) {
        $_SESSION['error'] = 'Username dan password harus diisi.';
        header('Location: login.php');
        exit();
    }

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ambil data pengguna dari tabel 'Users'
        // Kolom di database: Id_Users, Username, Password (P kapital)
        $stmt = $pdo->prepare('SELECT Id_Users, Username, Password FROM Users WHERE Username = :username'); // [cite: 211]
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password yang di-hash
        // Menggunakan 'Password' (P kapital) karena itu nama kolom di tabel Users [cite: 211]
        if ($user && password_verify($password_input, $user['Password'])) {
            $_SESSION['username'] = $user['Username']; // Gunakan 'Username' dari database [cite: 211]
            $_SESSION['user_id'] = $user['Id_Users']; // Gunakan 'Id_Users' dari database [cite: 211]
            header('Location: index.php'); // Arahkan ke halaman utama setelah login berhasil
            exit();
        } else {
            $_SESSION['error'] = 'Username atau password salah.'; // Pesan error jika kredensial tidak cocok
            header('Location: login.php'); // Redirect kembali ke halaman login
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Terjadi kesalahan database: " . $e->getMessage(); // Tangani error database
        header('Location: login.php');
        exit();
    }
} else {
    // Jika diakses langsung tanpa POST request, arahkan ke halaman login
    header('Location: login.php');
    exit();
}
?>