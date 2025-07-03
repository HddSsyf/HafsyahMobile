<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fungsi untuk mendapatkan satuan top-up berdasarkan judul game
function getUnitByGame($gameTitle) {
    $gameTitle = strtolower($gameTitle);
    if (strpos($gameTitle, 'call of duty') !== false) return 'CP';
    if (strpos($gameTitle, 'pubg') !== false) return 'UC';
    if (strpos($gameTitle, 'mobile legends') !== false || strpos($gameTitle, 'free fire') !== false) return 'Diamonds';
    return 'Item';
}

// Fungsi untuk menentukan harga berdasarkan game dan jumlah top up
function getPrice($gameTitle, $amount) {
    $title = strtolower($gameTitle);

    if (strpos($title, 'call of duty') !== false) {
        $prices = [
            '1000' => 10000,
            '2500' => 20000,
            '5000' => 35000,
            '10000' => 65000
        ];
    } elseif (strpos($title, 'pubg') !== false) {
        $prices = [
            '60' => 10000,
            '300' => 35000,
            '600' => 65000
        ];
    } elseif (strpos($title, 'mobile legends') !== false || strpos($title, 'free fire') !== false) {
        $prices = [
            '86' => 10000,
            '172' => 19000,
            '257' => 28000,
            '344' => 36000
        ];
    } else {
        $prices = ['1' => 10000];
    }

    return isset($prices[$amount]) ? $prices[$amount] : 0;
}

// Inisialisasi pesan error
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameId        = filter_input(INPUT_POST, 'gameId', FILTER_SANITIZE_NUMBER_INT);
    $gameTitle     = filter_input(INPUT_POST, 'gameTitle', FILTER_SANITIZE_STRING);
    $userId        = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $amount        = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
    $paymentMethod = filter_input(INPUT_POST, 'paymentMethod', FILTER_SANITIZE_STRING);

    if (empty($gameId) || empty($gameTitle) || empty($userId) || empty($amount) || empty($paymentMethod)) {
        $error = "Harap isi semua data dengan benar.";
    } else {
        $price = getPrice($gameTitle, $amount);

        if ($price > 0) {
            $_SESSION['cart'][] = [
                'gameId'        => $gameId,
                'gameTitle'     => $gameTitle,
                'userId'        => $userId,
                'amount'        => $amount,
                'price'         => $price,
                'paymentMethod' => $paymentMethod,
                'status'        => 'Pending'
            ];

            header('Location: keranjang.php');
            exit;
        } else {
            $error = "Jumlah top up tidak valid. Silakan pilih dari opsi yang tersedia.";
        }
    }

    if (!empty($error)) {
        $_SESSION['error_message'] = $error;
        header('Location: top_up.php?gameId=' . htmlspecialchars($gameId) . '&gameTitle=' . urlencode($gameTitle));
        exit;
    }
}

// Jika file diakses langsung
header('Location: games.php');
exit;
?>
