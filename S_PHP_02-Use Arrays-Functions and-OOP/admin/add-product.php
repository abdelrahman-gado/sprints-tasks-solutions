<?php

require_once __DIR__ . "/../logic/products.php";
require_once __DIR__ . "/../logic/validation.php";
require_once __DIR__ . "/../logic/files.php";



if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST) {
  // validate the values
  $errors = [];
  $oldValues = [];
  

  // validate the product name
  $name = validate($_POST, "name");
  if (!$name) {
    $errors["name"] = "Please enter a valid product Name";
  }

  // validatethe product description
  $description = validate($_POST, "description");
  if (!$description) {
    $errors["description"] = "Please enter a valid product description";
  }

  // validate the product image
  $file = validateFile($_FILES, 'image_url', 'image/');
  if ($file) {
    $image_url = uploadFile($file);
  } else {
    $errors["image_url"] = "Please enter a valid product image";
  }

  // validate the product price
  $price = validateNumber($_POST, 'price', PHP_INT_MAX, 0);
  if (!$price) {
    $errors["price"] = "Please enter a valid product price";
  }

  // validate the product Discount
  $discount = validateNumber($_POST, "discount", 100, 0);
  if ($discount) {
    $discount = $discount / 100;
  } else {
    $errors["discount"] = "Please enter a valid product discount";
  }

  // insert the values in the products table
  if (!$errors) {
    $bar_code = $_POST["bar_code"] ?? NULL;
    $size_id = (int) $_POST["size_id"];
    $color_id = (int) $_POST["color_id"];
    $category_id = (int) $_POST["category_id"];

    $is_recent = isset($_POST["is_recent"]) ? 1 : 0;
    $is_featured = isset($_POST["is_featured"]) ? 1 : 0;
    $result = addProduct(
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
    );


    if ($result) {
      header("Location: ./products.php");
      die();
    } else {
      echo "Error While Inserting Product in Database";
    }

  } else {
    // add values to oldValues to retreive them if there is any errors.
    $oldValues = $_POST;
  }
}


require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../logic/categories.php";
require_once __DIR__ . "/../logic/sizes.php";
require_once __DIR__ . "/../logic/colors.php";

$sizes = getSizes();
$colors = getColors();
$categories = getCategories();
?>

<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5 d-flex d-flex justify-content-center mb-2">
    <div class="col-lg-8 d-none d-lg-block">
      <h1 class="mb-3">Add Product</h1>
      <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Product Name: </label>
          <input type="text" class="form-control" id="name" name="name" value="<?= isset($oldValues["name"]) ? $oldValues["name"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["name"]) ? $errors["name"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="category_id">Product Category: </label>
          <select class="form-control" id="category_id" name="category_id">
            <?php
            foreach ($categories as $category) {
            ?>
              <option value="<?= $category["id"] ?>" <?= (isset($oldValues["category_id"]) && $category["id"] == $oldValues["category_id"]) ? 'selected' : "" ?>><?= $category["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Product Description: </label>
          <textarea class="form-control" id="description" name="description"><?= isset($oldValues["description"]) ? $oldValues["description"] : ""  ?></textarea>
          <span class="text-danger"><?= isset($errors["description"]) ? $errors["description"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="image_url">Product Image: </label>
          <input type="file" class="form-control-file" id="image_url" name="image_url">
          <span class="text-danger"><?= isset($errors["image_url"]) ? $errors["image_url"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="price">Product Price: </label>
          <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?= isset($oldValues["price"]) ? $oldValues["price"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["price"]) ? $errors["price"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="bar_code">Product Bar Code: </label>
          <input type="text" class="form-control" id="bar_code" name="bar_code" value="<?= isset($oldValues["bar_code"]) ? $oldValues["bar_code"] : "" ?>">
        </div>
        <div class="form-group">
          <label for="color_id">Color</label>
          <select class="form-control" id="color_id" name="color_id">
            <?php
            foreach ($colors as $color) {
            ?>
              <option value="<?= $color["id"] ?>" <?= (isset($oldValues["color_id"]) && $color["id"] == $oldValues["color_id"]) ? 'selected' : "" ?>><?= $color["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="size_id">Size</label>
          <select class="form-control" id="size_id" name="size_id">
            <?php
            foreach ($sizes as $size) {
            ?>
              <option value="<?= $size["id"] ?>" <?= (isset($oldValues["size_id"]) && $size["id"] == $oldValues["size_id"]) ? 'selected' : "" ?>><?= $size["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="discount">Product Discount (0% - 100%): </label>
          <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" step="0.1" value="<?= isset($oldValues["discount"]) ? $oldValues["discount"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["discount"]) ? $errors["discount"] : ""  ?></span>
        </div>
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_recent" name="is_recent" <?= isset($oldValues["is_recent"]) && $oldValues["is_recent"] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_recent">Recent</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" <?= isset($oldValues["is_featured"]) && $oldValues["is_featured"] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_featured">Featured</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add Product</button>
      </form>
    </div>
  </div>
</div>


<?php
require_once __DIR__ . "/../layouts/footer.php";
?>