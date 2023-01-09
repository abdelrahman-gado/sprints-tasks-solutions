<?php
require_once __DIR__ . "/../../logic/authentication.php";
protectAdmin();

require_once('../../logic/products.php');

$products = getProducts();
var_export($_REQUEST);
if (isset($_REQUEST["id"]) && $_REQUEST["id"]) {
  deleteProduct($_REQUEST["id"]);
  header("Location: index.php");
  die();
}