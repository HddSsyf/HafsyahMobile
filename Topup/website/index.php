<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafsyah Mobile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #000000; 
            color: #ffffff; 
        }
        .content {
            flex: 1;
        }
        .jumbotron {
            background: linear-gradient(to right, #007bff, #000000); 
            color: #ffffff;
        }
        .navbar {
            background: linear-gradient(to right, #000000, #007bff); 
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; 
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #cce4ff !important; 
        }
        .btn-primary {
            background-color: #007bff; 
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        footer {
            background: linear-gradient(to right, #007bff, #000000); 
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="content">
        <div class="container mt-5">
            <div class="jumbotron text-center">
                <h1 class="display-4">Selamat Datang di Situs Hafsyah Mobile</h1>
                <p class="lead">Tempat terbaik untuk top up game favorit Anda dengan harga terjangkau.</p>
            </div>
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