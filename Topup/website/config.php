<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_topup";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn_connect_error) {
    die("Connection failed: " . $conn_connect_error);
}
?>