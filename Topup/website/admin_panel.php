<?php
session_start();

// Autentikasi Admin
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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #495057;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 30px;
        }
        .card-title {
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar">
            <h4 class="text-center">Admin Panel</h4>
            <a href="products.php">Kelola Produk</a>
            <a href="orders.php">Pesanan</a>
            <a href="admin_logout.php">Keluar</a>
        </nav>

        <main class="col-md-10 content">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Selamat datang, Admin!</h3>
                    <p class="card-text">Gunakan menu di samping untuk mengelola produk, pesanan, dan pengguna.</p>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
