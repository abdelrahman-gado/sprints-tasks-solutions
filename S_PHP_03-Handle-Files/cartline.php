<?php
require_once __DIR__ . "/logic/cart.php";


if (isset($_GET["id"]) && isset($_GET["removed"]) && $_GET["removed"]) {
  // if remove cartline is pressed.
  removeCartItem($_GET["id"]);
  header("Location: cart.php");
  die();
} elseif (isset($_GET["id"]) && isset($_GET["decreased"]) && $_GET["decreased"]) {
  // if decrease quantity button pressed.
  decreaseCartItemQuantity($_GET["id"]);
  header("Location: cart.php");
  die();
} elseif (isset($_GET["id"]) && isset($_GET["increased"]) && $_GET["increased"]) {
  // if increase quantity is pressed.
  increaseCartItemQuantity($_GET["id"]);
  header("Location: cart.php");
  die();
} else {
  header("Location: index.php");
  die();
}