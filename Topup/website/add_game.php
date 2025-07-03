<?php
session_start(); // Pindahkan ini ke baris paling atas

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameTitle = filter_input(INPUT_POST, 'gameTitle', FILTER_SANITIZE_STRING);
    $gameDescription = filter_input(INPUT_POST, 'gameDescription', FILTER_SANITIZE_STRING);
    $gamePrice = filter_input(INPUT_POST, 'gamePrice', FILTER_SANITIZE_NUMBER_INT); // Ambil harga

    $gameImage = $_FILES['gameImage'];

    // Validasi input
    if (empty($gameTitle) || empty($gameDescription) || empty($gamePrice) || empty($gameImage['name'])) {
        // Handle error, mungkin redirect dengan pesan
        die("Error: Semua field harus diisi.");
    }

    // Buat direktori jika belum ada
    $targetDir = "assets/images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($gameImage["name"]);

    // Pindahkan file gambar
    if (move_uploaded_file($gameImage["tmp_name"], $targetFile)) {
        // Simpan data game ke database
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Perbaikan: Gunakan pernyataan INSERT INTO sesuai dengan tabel Games [cite: 213]
            // Kolom di database: Nama_Game, Deskripsi, Gambar, Harga [cite: 213]
            $stmt = $pdo->prepare('INSERT INTO Games (Nama_Game, Deskripsi, Gambar, Harga) VALUES (:Nama_Game, :Deskripsi, :Gambar, :Harga)'); // [cite: 213]
            $stmt->execute([
                ':Nama_Game' => $gameTitle,
                ':Deskripsi' => $gameDescription,
                ':Gambar' => $targetFile,
                ':Harga' => $gamePrice // Tambahkan parameter harga
            ]);

            // Redirect kembali ke halaman products setelah berhasil menambahkan game
            header('Location: products.php');
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Gagal mengunggah file gambar.";
    }
} else {
    // Jika diakses langsung tanpa POST request
    header('Location: products.php');
    exit();
}
?>