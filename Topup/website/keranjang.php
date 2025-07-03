<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['item_index'])) {
    $item_index = filter_input(INPUT_GET, 'item_index', FILTER_SANITIZE_NUMBER_INT);
    if (isset($_SESSION['cart'][$item_index])) {
        unset($_SESSION['cart'][$item_index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header('Location: keranjang.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'clear_all') {
    unset($_SESSION['cart']);
    $_SESSION['cart'] = [];
    header('Location: keranjang.php');
    exit;
}

$cart_items = $_SESSION['cart'] ?? [];
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #1a1a1a, #000000);
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
            padding: 40px 15px;
        }
        .cart-header {
            text-align: center;
            color: #00bfff;
            font-weight: bold;
            margin-bottom: 40px;
        }
        .cart-item {
            background-color: #2e2e2e;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .cart-item-details {
            flex: 1;
        }
        .cart-item-details h5 {
            color: #00bfff;
            font-weight: bold;
        }
        .cart-item-details p {
            margin: 3px 0;
            color: #ccc;
            font-size: 0.95rem;
        }
        .btn-remove {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .btn-remove:hover {
            background-color: #b52a3b;
        }
        .cart-total {
            background-color: #1c1c1c;
            color: #00bfff;
            padding: 20px;
            border-radius: 10px;
            font-weight: bold;
            text-align: right;
            margin-top: 30px;
            font-size: 1.2rem;
        }
        .btn-checkout, .btn-clear-cart {
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 25px;
            font-size: 1rem;
            margin: 10px 10px 0 0;
        }
        .btn-checkout {
            background-color: #28a745;
            color: #fff;
        }
        .btn-checkout:hover {
            background-color: #218838;
        }
        .btn-clear-cart {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-clear-cart:hover {
            background-color: #5a6268;
        }
        .empty-cart-message {
            background-color: #2a2a2a;
            text-align: center;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            font-size: 1.1rem;
        }
        footer {
            background: linear-gradient(135deg, #007bff, #000000);
            text-align: center;
            color: #fff;
            padding: 15px 0;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2 class="cart-header"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>

    <?php if (empty($cart_items)): ?>
        <div class="empty-cart-message">
            Keranjang Anda masih kosong. <br>
            Yuk <a href="games.php" class="text-info font-weight-bold">top up game</a> sekarang!
        </div>
    <?php else: ?>
        <form action="checkout.php" method="POST">
            <?php foreach ($cart_items as $index => $item): ?>
                <div class="cart-item">
                    <div class="cart-item-details">
                        <input type="checkbox" name="selectedItems[]" value="<?= $index ?>" checked>
                        <h5><?= htmlspecialchars($item['gameTitle']) ?></h5>
                        <p>User ID: <?= htmlspecialchars($item['userId']) ?></p>
                        <p>Jumlah: <?= htmlspecialchars($item['amount']) ?></p>
                        <p>Metode Pembayaran: <?= htmlspecialchars(ucfirst($item['paymentMethod'])) ?></p>
                        <p>Harga: Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                    </div>
                    <div>
                        <a href="keranjang.php?action=remove&item_index=<?= $index ?>" class="btn btn-remove"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-total">
                Total: Rp <?= number_format($total_price, 0, ',', '.') ?>
            </div>

            <div class="text-center mt-4">
                <a href="keranjang.php?action=clear_all" class="btn btn-clear-cart"><i class="fas fa-trash"></i> Kosongkan</a>
                <button type="submit" class="btn btn-checkout"><i class="fas fa-credit-card"></i> Checkout</button>
            </div>
        </form>
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
