<?php

require_once __DIR__ . "/logic/products.php";
require_once __DIR__ . "/logic/cart.php";

if (isset($_GET['id'])) {
  $product = getProductById($_GET['id']);
  if ($product) {
    addProductToCart($product);
  }
}


header("Location: cart.php");
die();