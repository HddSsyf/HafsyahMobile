<?php
session_start();

// Cek apakah ada data produk yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedProducts'])) {
    $selectedProducts = json_decode($_POST['selectedProducts'], true);

    if (!$selectedProducts || !is_array($selectedProducts)) {
        echo "<script>alert('Data pesanan tidak valid.'); window.location.href='keranjang.php';</script>";
        exit;
    }

    // Simpan ke database (jika diperlukan)
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($selectedProducts as $product) {
            $stmt = $pdo->prepare("INSERT INTO Pesanan (Nama_Game, User_ID, Jumlah, Metode_Pembayaran, Harga, Tanggal_Pesan) VALUES (:gameTitle, :userId, :amount, :paymentMethod, :price, NOW())");
            $stmt->execute([
                ':gameTitle' => $product['gameTitle'],
                ':userId' => $product['userId'],
                ':amount' => $product['amount'],
                ':paymentMethod' => $product['paymentMethod'],
                ':price' => $product['price']
            ]);
        }

    } catch (PDOException $e) {
        echo "Gagal menyimpan pesanan: " . $e->getMessage();
        exit;
    }

    // Hapus item yang sudah diproses dari sesi cart
    foreach ($selectedProducts as $selected) {
        foreach ($_SESSION['cart'] as $i => $item) {
            if ($item == $selected) {
                unset($_SESSION['cart'][$i]);
            }
        }
    }
    // Reindex
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Tampilkan halaman sukses
    ?>
    
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Pembayaran Berhasil</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: Arial, sans-serif;
            }
            .success-box {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                text-align: center;
            }
            .success-box h2 {
                color: #28a745;
                margin-bottom: 20px;
            }
            .success-box a {
                margin-top: 20px;
                display: inline-block;
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 25px;
                text-decoration: none;
            }
            .success-box a:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="success-box">
            <h2><i class="fas fa-check-circle"></i> Pembayaran Berhasil!</h2>
            <p>Pesanan Anda telah diproses. Terima kasih telah melakukan top up di Hafsyah Mobile.</p>
            <a href="games.php">Kembali ke Halaman Game</a>
        </div>
    </body>
    </html>

    <?php
} else {
    // Jika tidak ada data dikirim
    echo "<script>alert('Akses tidak valid.'); window.location.href='keranjang.php';</script>";
    exit;
}
?>
