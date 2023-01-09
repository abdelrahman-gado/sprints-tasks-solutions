<?php

require_once __DIR__  . "/../dal/dal.php";
require_once __DIR__ . "/../layouts/stars.php";

function getProducts($where = "1=1", $limit = '')
{
  $q = "SELECT p.*, c.name as category_name, s.name as size_name, cl.name as color_name, 
  r.rating, r.rating_count FROM products as p 
  LEFT JOIN categories c ON p.category_id = c.id 
  LEFT JOIN sizes as s ON s.id = p.size_id 
  LEFT JOIN colors as cl ON cl.id = p.color_id 
  LEFT JOIN (SELECT product_id, AVG(rate) as rating, COUNT(0) as rating_count FROM ratings 
  GROUP BY product_id) as r ON r.product_id = p.id WHERE $where $limit";

  return get_rows($q);
}

function deleteProduct($id)
{
  $query = "DELETE FROM products WHERE id = " . $id;

  try {
    $result = execute($query);
  } catch (Exception $e) {
    if (session_start() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION['error_message'] = "Error while deleting the product";
    $result = false;
    $e->getMessage();
  }

  return $result;
}

function addProducts($values)
{
  $query = "INSERT INTO products (name,description,price,discount,image_url
,category_id,size_id,color_id,is_recent,is_featured,bar_code) VALUES (
        '" . $values['name'] . "','" . $values['description'] . "'," . $values['price'] . ",
        " . $values['discount'] . ",'" . $values['image_url'] . "'," . $values['category_id'] . "
        ," . $values['size_id'] . "," . $values['color_id'] . "," . $values['is_recent'] . "," . $values['is_featured'] . "
        ," . ($values['bar_code'] ? "'" . $values['bar_code'] . "'" : 'NULL') . ")";
  return execute($query);
}

function getProductById($id)
{
  $q = "SELECT * FROM products WHERE id = $id";
  return get_row($q);
}


function editProduct($values)
{
  $query = "UPDATE products SET 
    name='" . $values['name'] . "'
    ,description='" . $values['description'] . "'
    ,price=" . $values['price'] . "
    ,discount=" . $values['discount'] . "
    ,image_url='" . $values['image_url'] . "'
    ,category_id=" . $values['category_id'] . "
    ,size_id=" . $values['size_id'] . "
    ,color_id=" . $values['color_id'] . "
    ,is_recent=" . $values['is_recent'] . "
    ,is_featured=" . $values['is_featured'] . "
    ,bar_code=" . ($values['bar_code'] ? "'" . $values['bar_code'] . "'" : 'NULL') . "
    WHERE id=" . $values['id'];

  return execute($query);
}

function display_products($product, $class = "col-lg-3 col-md-4 col-sm-6 pb-1")
{
  return '<div class="' . $class . '">
      <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
          <img class="img-fluid w-100" src="' . $product["image_url"] . '" alt="">
          <div class="product-action">
            <a class="btn btn-outline-dark btn-square" href="/addproduct.php?id=' . $product['id'] . '"><i class="fa fa-shopping-cart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
          </div>
        </div>
        <div class="text-center py-4">
          <a class="h6 text-decoration-none text-truncate" href="product.php?id=' . $product['id'] . '">' . $product["name"] . '</a>
          <div class="d-flex align-items-center justify-content-center mt-2">
            <h5>$' . ($product["price"] - ($product["price"] * $product["discount"])) . '</h5>
            <h6 class="text-muted ml-2"><del>$' . $product["price"] . '</del></h6>
          </div>
          <div class="d-flex align-items-center justify-content-center mb-1">' .
    getStars($product['rating'])
    . '<small>(' . $product["rating_count"] . ')</small>
          </div>
        </div>
      </div>
    </div>';
}

function getProductsByFilter($page, $itemPerPage, $category_id, $keyword, $colors, $sizes, $prices)
{
  $where = getWhere($category_id, $keyword, $colors, $sizes, $prices);
  $limit = "LIMIT " . ($page * $itemPerPage) . ", $itemPerPage";
  return getProducts($where, $limit);
}

function getTotalCountByFilter($category_id, $keyword, $colors, $sizes, $prices)
{
  $q = "SELECT COUNT(0) AS cnt FROM products WHERE " . getWhere($category_id, $keyword, $colors, $sizes, $prices);
  return get_row($q)['cnt'];
}

function getWhere($category_id, $keyword, $colors, $sizes, $prices)
{
  $where = "1=1";
  if ($category_id) {
    $where .= " AND category_id = $category_id";
  }

  if ($keyword) {
    $where .= " AND p.name LIKE '%$keyword%'";
  }

  if ($colors && !in_array("0", $colors)) {
    $where .= " AND color_id IN (" . implode(',', $colors) . ")";
  }

  if ($sizes && !in_array("0", $sizes)) {
    $where .= " AND size_id IN (" . implode(',', $sizes) . ")";
  }

  if ($prices && !in_array("0", $prices)) {
    $where .= " AND (" .
      implode(
        " OR ",
        array_map(fn ($item) => "(price BETWEEN " . str_replace('-', ' AND ', $item) . ")", $prices)
      ) . ")";
  }

  return $where;
}
