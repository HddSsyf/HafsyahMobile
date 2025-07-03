<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f3f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1, h2 {
            color: #343a40;
        }
        .form-control, .form-control-file {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
        }
        .btn-danger {
            border-radius: 20px;
        }
        table img {
            width: 80px;
            border-radius: 10px;
        }
        .card {
            padding: 20px;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<?php include 'admin_navbar.php'; ?>
<div class="container">
    <div class="card mb-4">
        <h2 class="mb-3">Tambahkan Game Baru</h2>
        <form action="add_game.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gameTitle" class="form-label">Judul Game</label>
                <input type="text" id="gameTitle" name="gameTitle" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gameDescription" class="form-label">Deskripsi Game</label>
                <textarea id="gameDescription" name="gameDescription" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="gamePrice" class="form-label">Harga Awal</label>
                <input type="number" id="gamePrice" name="gamePrice" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gameImage" class="form-label">Gambar Game</label>
                <input type="file" id="gameImage" name="gameImage" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan Game</button>
        </form>
    </div>

    <div class="card">
        <h2 class="mb-3">Daftar Game</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Judul Game</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $pdo->query("SELECT Id_Game, Nama_Game, Deskripsi, Gambar FROM Games");

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Nama_Game']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Deskripsi']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['Gambar']) . "' alt='" . htmlspecialchars($row['Nama_Game']) . "'></td>";
                            echo "<td><a href='delete_game.php?id=" . htmlspecialchars($row['Id_Game']) . "' class='btn btn-danger btn-sm'>Hapus</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Tidak ada game tersedia.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
