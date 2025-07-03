<?php
$conn = new mysqli('localhost', 'root', '', 'ecommerce_topup');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$gameId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT image FROM games WHERE id = $gameId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image = $row['image'];
    if (file_exists("assets/images/" . $image)) {
        unlink("assets/images/" . $image);
    }
    $sql = "DELETE FROM games WHERE id = $gameId";
    if ($conn->query($sql) === TRUE) {
        echo "Game deleted successfully";
    } else {
        echo "Error deleting game: " . $conn->error;
    }
} else {
    echo "Game not found";
}
$conn->close();
header("Location: products.php");
exit();
?>
