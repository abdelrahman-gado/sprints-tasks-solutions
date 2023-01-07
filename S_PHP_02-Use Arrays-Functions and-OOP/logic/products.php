<?php

require_once __DIR__ . "/../dal/dal.php";

function getProducts()
{
  $q = "SELECT p.*, c.name as category_name, s.name as size_name, cl.name as color_name, r.rating, r.rating_count FROM products as p LEFT JOIN categories c ON p.category_id = c.id JOIN sizes as s ON s.id = p.size_id LEFT JOIN colors as cl ON cl.id = p.color_id LEFT JOIN (SELECT product_id, AVG(rate) as rating, COUNT(0) as rating_count FROM ratings GROUP BY product_id) as r ON r.product_id = p.id";

  return get_rows($q);
}


function getProductById($id)
{
  $q = "SELECT * FROM products WHERE id = " . $id;
  return getSingleRow($q);
}


function addProduct(
  $name,
  $description,
  $image_url,
  $price,
  $bar_code,
  $size_id,
  $color_id,
  $category_id,
  $discount,
  $is_recent,
  $is_featured
) {
  $q = "INSERT INTO products (name, description, image_url, price, bar_code,
   size_id, color_id, category_id, discount, is_recent, is_featured) VALUES ( '" . $name . "', 
   '" . $description . "', '" . $image_url . "', " . $price . ", '" . $bar_code . "', " . $size_id . ", 
   " . $color_id . ", " . $category_id . ", " . $discount . ", " . $is_recent . ", " . $is_featured . ")";

  return execute($q);
}


function updateProduct(
  $id,
  $name,
  $description,
  $image_url,
  $price,
  $bar_code,
  $size_id,
  $color_id,
  $category_id,
  $discount,
  $is_recent,
  $is_featured
) {
  $q = "UPDATE products SET name = '" . $name . "', description = '" . $description . "', 
    image_url = '" . $image_url . "', price = " . $price . ", bar_code = '" . $bar_code . "', 
    size_id = " . $size_id . ", color_id = " . $color_id . ", category_id = " . $category_id . ", 
    discount = " . $discount . ", is_recent = " . $is_recent . ", is_featured = " . $is_featured . " 
    WHERE id = " . $id;

  return execute($q);
}


function deleteProductById($id) {
  // Get image url that relates to this products and delete it (unlink)
  $product  = getProductById($id);
  if (!$product) {
    header("Location: products.php");
    die();
  }

  $image_url = $product["image_url"];
  $filename = "../" . $image_url;
  $deleted = unlink($filename);

  if (!$deleted) {
    return false;
  }

  // Delete product.
  $query = "DELETE FROM products WHERE id = " . $id;

  $done = execute($query);

  return $done;
}