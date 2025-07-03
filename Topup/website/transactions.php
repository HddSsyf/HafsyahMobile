<?php
session_start(); // Pindahkan ini ke baris paling atas
// Mungkin perlu cek sesi admin di sini
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header('Location: admin_login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'admin_navbar.php'; ?>
    <div class="container mt-5">
        <h1>Transactions</h1>
        <p>Manage your transactions here.</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>User ID</th>
                    <th>Game ID</th>
                    <th>Jumlah Topup</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status Transaksi</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Perbaikan: Ubah 'transactions' menjadi 'Transaksi'
                    // Kolom di database: Transaksi_Id, User_Id, Game_Id, Jumlah_Topup, Metode_Pembayaran, Bukti_Pembayaran, Status_Transaksi, Tgl_Transaksi [cite: 215]
                    $stmt = $pdo->query('SELECT * FROM Transaksi ORDER BY Tgl_Transaksi DESC'); // [cite: 215]
                    
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Sesuaikan nama kolom dengan yang ada di tabel 'Transaksi' [cite: 215]
                            echo '<td>' . htmlspecialchars($row['Transaksi_Id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['User_Id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Game_Id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Jumlah_Topup']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Metode_Pembayaran']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Bukti_Pembayaran']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Status_Transaksi']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Tgl_Transaksi']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8">No transactions found</td></tr>'; // Sesuaikan colspan
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>