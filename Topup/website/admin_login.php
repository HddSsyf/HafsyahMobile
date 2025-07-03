<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Admin</h2>
                        <form action="admin_login_process.php" method="post">
                            <div class="form-group">
                                <label for="admin_username">Username</label>
                                <input type="text" id="admin_username" name="admin_username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_password">Password</label>
                                <input type="password" id="admin_password" name="admin_password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Atau kembali ke:</p>
                            <a href="index.php" class="btn btn-secondary btn-block">Home</a>
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
