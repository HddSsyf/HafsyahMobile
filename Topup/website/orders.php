<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #343a40;
            margin-bottom: 20px;
        }
        table img {
            width: 60px;
            border-radius: 8px;
        }
        .badge-status {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-success { background-color: #28a745; }
        .badge-failed  { background-color: #dc3545; }
    </style>
</head>
<body>
<?php include 'admin_navbar.php'; ?>

<div class="container">
    <div class="card">
        <h2>Daftar Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Game</th>
                        <th>User ID</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $pdo->query("SELECT * FROM Pesanan ORDER BY Tanggal_Pesan DESC");

                    if ($stmt->rowCount() > 0) {
                        $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nama_Game']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['User_ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Jumlah']) . "</td>";
                            echo "<td>" . htmlspecialchars(ucfirst($row['Metode_Pembayaran'])) . "</td>";
                            echo "<td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>";
                            echo "<td>" . date('d-m-Y H:i', strtotime($row['Tanggal_Pesan'])) . "</td>";

                            // Status bisa disesuaikan jika kolom tersedia
                            echo "<td><span class='badge badge-status badge-pending'>Pending</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Belum ada pesanan.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
