<?php
function addProductToCart($product)
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
  $found = false;
  for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['product']['id'] === $product['id']) {
      $cart[$i]['quantity'] += 1;
      $found = true;
    }
  }

  if (!$found) {
    array_push($cart, ['product' => $product, 'quantity' => 1]);
  }

  $_SESSION['cart'] = $cart;
}

function getCart()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
  return $cart;
}

// find cart line by product id in the $_SESSION superglobal array 
// and return its index or -1 if it is not found 
function findCartItemById(int $productId) {
  $cart = getCart();
  $index = -1;
  for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]["product"]["id"] == $productId) {
      $index = $i;
      break;
    }
  }

  return $index;
}

// remove cart line from $_SESSION superglobal array
function removeCartItem(int $productId) {
  
  $index = findCartItemById($productId);

  if ($index === -1) {
    header("Location: index.php");
    die();
  } else {
    array_splice($_SESSION["cart"], $index, 1);
  }
}

// decrease quantity of cart line from $_SESSION superglobal array
function decreaseCartItemQuantity($productId) {
  $index = findCartItemById($productId);
  if ($index === -1) {
    header("Location: index.php");
    die();
  } else {
    $_SESSION["cart"][$index]["quantity"] -= 1;
  }
}

// increase quantity of cart line from $_SESSION superglobal array
function increaseCartItemQuantity($productId)
{
  $index = findCartItemById($productId);
  if ($index === -1) {
    header("Location: index.php");
    die();
  } else {
    $_SESSION["cart"][$index]["quantity"] += 1;
  }
}


function getPriceAfterDiscount(float $price, float $discount)
{
  return ($price - ($price * $discount));
}

function calculateTotalPerItem(float $priceAfterDiscount, int $quantity)
{
  return $priceAfterDiscount * $quantity;
}

function calculateCartSubTotal()
{
  $cartItems = getCart();

  return array_reduce($cartItems, function ($total, $item) {
    $finalPrice = getPriceAfterDiscount($item["product"]["price"], $item["product"]["discount"]);
    $totalPerItem = calculateTotalPerItem($finalPrice, $item["quantity"]);
    return $total + $totalPerItem;
  }, 0);
}

function calculateCartShipping() {
  $cartItems = getCart();
  return count($cartItems) * 1.5;
}

function calculateCartTotal() {
  return calculateCartSubTotal() + calculateCartShipping();
}


function countCartProducts() {
  $cartItems = getCart();
  return array_reduce($cartItems, fn($count, $item) => $count += $item["quantity"], 0);
}
