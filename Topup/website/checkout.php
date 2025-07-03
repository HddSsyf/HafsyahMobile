<?php
session_start();

$selectedProducts = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedItems'])) {
    $selectedItems = $_POST['selectedItems'];
    $selectedProducts = array_intersect_key($_SESSION['cart'], array_flip($selectedItems));
} else {
    echo "<script>alert('Tidak ada item yang dipilih.'); window.location.href='keranjang.php';</script>";
    exit;
}

$totalPrice = array_sum(array_column($selectedProducts, 'price'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1c1c1c, #000000);
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
            margin-top: 50px;
            background-color: #2a2a2a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
        }
        h3 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .table {
            background-color: #343a40;
            color: #ffffff;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
        }
        .btn-checkout {
            background-color: #28a745;
            border: none;
            padding: 10px 24px;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-checkout:hover {
            background-color: #218838;
        }
        .summary {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #00ff99;
        }
        footer {
            background: linear-gradient(135deg, #007bff, #000000);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h3><i class="fas fa-receipt"></i> Checkout</h3>
    <p class="text-center text-light">Berikut adalah detail pesanan Anda:</p>

    <?php if (!empty($selectedProducts)): ?>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Nama Game</th>
                    <th>User ID</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selectedProducts as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['gameTitle']); ?></td>
                        <td><?php echo htmlspecialchars($product['userId']); ?></td>
                        <td><?php echo htmlspecialchars($product['amount']); ?></td>
                        <td>Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="summary">
            Total Harga: Rp<?php echo number_format($totalPrice, 0, ',', '.'); ?>
        </div>

        <form method="POST" action="proses_pembayaran.php" class="text-right mt-4">
            <input type="hidden" name="selectedProducts" value="<?php echo htmlspecialchars(json_encode($selectedProducts)); ?>">
            <button type="submit" class="btn btn-checkout"><i class="fas fa-money-bill-wave"></i> Lanjutkan Pembayaran</button>
        </form>
    <?php else: ?>
        <p class="text-center text-danger">Tidak ada produk yang dipilih untuk checkout.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Hafsyah Mobile. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
