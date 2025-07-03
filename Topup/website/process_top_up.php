<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameId = $_POST['gameId'];
    $userId = $_POST['userId'];
    $amount = $_POST['amount'];
    $paymentMethod = $_POST['paymentMethod'];
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_topup', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO transactions (gameId, userId, amount, paymentMethod) VALUES (:gameId, :userId, :amount, :paymentMethod)');
        $stmt->execute([
            ':gameId' => $gameId,
            ':userId' => $userId,
            ':amount' => $amount,
            ':paymentMethod' => $paymentMethod
        ]);

        header('Location: top_up_success.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>