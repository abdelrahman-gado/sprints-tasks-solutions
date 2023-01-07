<?php
require_once __DIR__ . "/../dal/dal.php";
require_once __DIR__ . "/../logic/products.php";

$product_id = $_POST["id"];

$done = deleteProductById($product_id);

if ($done) {
  header("Location: products.php");
  die();
} else {
  echo "Error: failed to delete this product";
}