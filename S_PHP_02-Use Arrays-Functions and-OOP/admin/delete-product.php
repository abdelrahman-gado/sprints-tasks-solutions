<?php
require_once __DIR__ . "/../dal/dal.php";

$product_id = $_POST["id"];

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");

if (!$stmt) {
  header("Location: product.php");
}

$stmt->bind_param("i", $product_id);
$done = $stmt->execute();

if ($done) {
  header("Location: products.php");
}