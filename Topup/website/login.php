<?php
session_start(); // Pindahkan ini ke baris paling atas
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #2980b9);
            color: black;
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2980b9;
        }
        .text-center a {
            color: #2980b9;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: none;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">User</h2>
                        <?php
                        // Pesan error dari sesi ditampilkan di sini
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form action="login_process.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>