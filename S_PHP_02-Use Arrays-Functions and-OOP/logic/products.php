<?php

require_once __DIR__ . "/../dal/dal.php";

function getProducts()
{
  $q = "SELECT p.*, c.name as category_name, s.name as size_name, cl.name as color_name, r.rating, r.rating_count FROM products as p JOIN categories c ON p.category_id = c.id JOIN sizes as s ON s.id = p.size_id JOIN colors as cl ON cl.id = p.color_id JOIN (SELECT product_id, AVG(rate) as rating, COUNT(0) as rating_count FROM ratings GROUP BY product_id) as r ON r.product_id = p.id";

  return get_rows($q);
}


function getProductById($id) {
  $q = "SELECT * FROM products WHERE id = " . $id;
  return get_rows($q);
}