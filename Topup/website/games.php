<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to bottom right, #121212, #1f1f1f);
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
        }

        .game-card {
            background-color: #242424;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .game-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.6);
        }

        .game-card img {
            height: 150px;
            object-fit: cover;
            width: 100%;
        }

        .game-card .card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #00bfff;
            margin-bottom: 8px;
        }

        .card-text {
            font-size: 0.9rem;
            color: #ccc;
            margin-bottom: 12px;
        }

        .btn-topup {
            background-color: #00bfff;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-topup:hover {
            background-color: #0099cc;
        }

        footer {
            background: linear-gradient(to right, #007bff, #000000);
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2 class="text-center text-info mb-4"><i class="fas fa-gamepad"></i> Daftar Game</h2>
    <div class="games-grid">
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query('SELECT * FROM Games');
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $description = htmlspecialchars($row['Deskripsi']);
                echo '<div class="game-card">';
                echo '  <img src="' . htmlspecialchars($row['Gambar']) . '" alt="' . htmlspecialchars($row['Nama_Game']) . '">';
                echo '  <div class="card-body">';
                echo '    <h5 class="card-title">' . htmlspecialchars($row['Nama_Game']) . '</h5>';
                echo '    <p class="card-text">' . substr($description, 0, 70) . '... <a href="#" onclick="showMore(this, \'' . addslashes($description) . '\')" class="text-info">selengkapnya</a></p>';
                echo '    <a href="top_up.php?gameId=' . htmlspecialchars($row['Id_Game']) . '&gameTitle=' . urlencode($row['Nama_Game']) . '" class="btn btn-topup"><i class="fas fa-coins mr-1"></i> Top Up</a>';
                echo '  </div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '<p class="text-danger text-center">Gagal memuat data game: ' . $e->getMessage() . '</p>';
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Hafsyah Mobile. All rights reserved.</p>
</footer>

<script>
function showMore(link, fullDescription) {
    link.parentElement.innerHTML = fullDescription;
}
</script>
</body>
</html>
