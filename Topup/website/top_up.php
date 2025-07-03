<?php
session_start();

// Ambil data dari URL
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : '';
$gameTitle = isset($_GET['gameTitle']) ? $_GET['gameTitle'] : '';

// Fungsi untuk menentukan satuan top-up berdasarkan nama game
function getUnitByGame($gameTitle) {
    $gameTitle = strtolower($gameTitle);
    if (strpos($gameTitle, 'call of duty') !== false) return 'CP';
    if (strpos($gameTitle, 'pubg') !== false) return 'UC';
    if (strpos($gameTitle, 'mobile legends') !== false || strpos($gameTitle, 'free fire') !== false) return 'Diamonds';
    return 'Item';
}

$unit = getUnitByGame($gameTitle);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Top Up Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
            padding-top: 40px;
            padding-bottom: 30px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
            color: #333;
        }
        .card-title {
            text-align: center;
            font-weight: 700;
            font-size: 1.4rem;
            color: #007bff;
            margin-bottom: 1.2rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            font-weight: 600;
            font-size: 0.95rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 0.95rem;
        }
        .form-icon-group {
            position: relative;
        }
        .form-icon-group .form-control {
            padding-left: 36px;
        }
        .form-icon-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 0.9rem;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-weight: bold;
            font-size: 1rem;
            border-radius: 25px;
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert-danger {
            font-size: 0.85rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        footer {
            background: linear-gradient(135deg, #007bff, #000000);
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="card mx-auto p-3" style="max-width: 480px;">
        <h3 class="card-title">Formulir Top Up Game</h3>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="gameId" value="<?php echo htmlspecialchars($gameId); ?>">
            <input type="hidden" name="gameTitle" value="<?php echo htmlspecialchars($gameTitle); ?>">

            <div class="form-group form-icon-group">
                <label for="game_display">Game yang Dipilih</label>
                <i class="fas fa-gamepad"></i>
                <input type="text" id="game_display" class="form-control" value="<?php echo htmlspecialchars($gameTitle); ?>" readonly>
            </div>

            <div class="form-group form-icon-group">
                <label for="userId">User ID</label>
                <i class="fas fa-user"></i>
                <input type="text" id="userId" name="userId" class="form-control" placeholder="Masukkan User ID Anda" required>
            </div>

            <div class="form-group form-icon-group">
                <label for="amount">Jumlah Top Up</label>
                <i class="fas fa-coins"></i>
                <select id="amount" name="amount" class="form-control" required>
                    <option value="">Pilih Jumlah</option>
                    <?php if ($unit === 'CP'): ?>
                        <option value="1000" data-price="10000">1000 CP - Rp10.000</option>
                        <option value="2500" data-price="20000">2500 CP - Rp20.000</option>
                        <option value="5000" data-price="35000">5000 CP - Rp35.000</option>
                        <option value="10000" data-price="65000">10000 CP - Rp65.000</option>
                    <?php elseif ($unit === 'UC'): ?>
                        <option value="60" data-price="10000">60 UC - Rp10.000</option>
                        <option value="300" data-price="35000">300 UC - Rp35.000</option>
                        <option value="600" data-price="65000">600 UC - Rp65.000</option>
                    <?php elseif ($unit === 'Diamonds'): ?>
                        <option value="86" data-price="10000">86 Diamonds - Rp10.000</option>
                        <option value="172" data-price="19000">172 Diamonds - Rp19.000</option>
                        <option value="257" data-price="28000">257 Diamonds - Rp28.000</option>
                        <option value="344" data-price="36000">344 Diamonds - Rp36.000</option>
                    <?php else: ?>
                        <option value="1" data-price="10000">1 Item - Rp10.000</option>
                    <?php endif; ?>
                </select>
                <small class="form-text text-muted">Satuan Top Up: <strong><?php echo $unit; ?></strong></small>
            </div>

            <div class="form-group form-icon-group">
                <label for="paymentMethod">Metode Pembayaran</label>
                <i class="fas fa-wallet"></i>
                <select id="paymentMethod" name="paymentMethod" class="form-control" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="dana">DANA</option>
                    <option value="ovo">OVO</option>
                    <option value="gopay">Gopay</option>
                    <option value="linkaja">LinkAja</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Tambah ke Keranjang</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Hafsyah Mobile. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
