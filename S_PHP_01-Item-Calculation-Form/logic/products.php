<?php

function getProducts() {
  $products = [];
  $file = fopen(__DIR__ . "/../data/products.csv", "r") or die();
  while (!feof($file)) {
    $line = fgets($file);
    $arr = explode(",", $line);
    $product = [
      "id" => (int) $arr[0],
      "name" => $arr[1],
      "price" => (float) $arr[2],
      "discount" => (float) $arr[3],
      "rating" => (float) $arr[4],
      "is_featured" => $arr[5] === "true" ? true : false, // convert string to bool
      "rating_count" => (int) $arr[6],
      "image" => $arr[7],
      "is_recent" => trim($arr[8]) === "true" ? true : false // you need to rim (\n) 
      // new line character, then convert string to bool
    ];

    array_push($products, $product);
  }

  return $products;
}