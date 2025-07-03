<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Inisialisasi pesan error
$error = '';

// Periksa apakah form dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form dan sanitasi
    $gameId        = filter_input(INPUT_POST, 'gameId', FILTER_SANITIZE_NUMBER_INT);
    $gameTitle     = filter_input(INPUT_POST, 'gameTitle', FILTER_SANITIZE_STRING);
    $userId        = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING); // Sesuaikan filter jika format User ID spesifik (e.g., FILTER_VALIDATE_INT)
    $amount        = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
    $paymentMethod = filter_input(INPUT_POST, 'paymentMethod', FILTER_SANITIZE_STRING);

    // Validasi dasar input
    if (empty($gameId) || empty($gameTitle) || empty($userId) || empty($amount) || empty($paymentMethod)) {
        $error = "Harap isi semua data dengan benar.";
    } else {
        // Tentukan harga berdasarkan jumlah top up yang dipilih
        // Ini harus sinkron dengan nilai data-price di HTML Anda
        $prices = [
            '1000' => 10000,
            '2500' => 20000,
            '5000' => 35000,
            '10000' => 65000
        ];

        $price = isset($prices[$amount]) ? $prices[$amount] : 0;

        if ($price > 0) {
            // Tambahkan item top-up ke dalam keranjang (sesi)
            $_SESSION['cart'][] = [
                'gameId'        => $gameId,
                'gameTitle'     => $gameTitle,
                'userId'        => $userId,
                'amount'        => $amount,
                'price'         => $price,
                'paymentMethod' => $paymentMethod,
                'status'        => 'Pending' // Status awal transaksi di keranjang
            ];

            // Redirect pengguna ke halaman keranjang
            header('Location: keranjang.php');
            exit; // Penting: Hentikan eksekusi skrip setelah redirect
        } else {
            $error = "Jumlah top up tidak valid. Silakan pilih dari opsi yang tersedia.";
        }
    }
}

// Jika ada error, simpan pesan error di sesi dan arahkan kembali ke halaman top_up
if (!empty($error)) {
    $_SESSION['error_message'] = $error;
    // Redirect kembali ke halaman top_up dengan parameter gameId dan gameTitle
    header('Location: top_up.php?gameId=' . htmlspecialchars($gameId) . '&gameTitle=' . urlencode($gameTitle));
    exit;
}

// Jika file ini diakses langsung (bukan dari POST form), arahkan ke halaman games
header('Location: games.php');
exit;
?>