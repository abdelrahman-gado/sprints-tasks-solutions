<?php


require_once __DIR__ . '/../dal/dal.php';

function getCategories()
{
  return get_rows("SELECT c.*, IFNULL(p.product_count, 0) as product_count FROM categories as c LEFT JOIN (SELECT COUNT(0) as product_count, category_id FROM products GROUP BY category_id) as p ON c.id = p.category_id
");
}
