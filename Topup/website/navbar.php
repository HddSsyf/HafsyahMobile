<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <a class="navbar-brand" href="index.php">Hafsyah Mobile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="games.php">Game</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="keranjang.php">Keranjang</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="login.php">Login User</a>
                    <a class="dropdown-item" href="admin_login.php">Login Admin</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
    .bg-custom {
        background: linear-gradient(to right, #000000, #007bff);
    }
    .navbar-brand {
        color: #ffffff !important;
    }
    .nav-link {
        color: #ffffff !important;
    }
    .nav-link:hover {
        color: #cce4ff !important; /* Slightly lighter blue */
    }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28332,332,332,1%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>
