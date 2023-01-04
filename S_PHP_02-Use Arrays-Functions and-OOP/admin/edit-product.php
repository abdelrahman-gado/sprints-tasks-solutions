<?php

require_once __DIR__ . "/../logic/products.php";

if (count($_POST) == 1 && isset($_POST["id"]) && !empty($_POST["id"])) {
  $id = $_POST["id"];
  $result = getProductById($id);
  if (count($result) > 0) {
    $oldValues = $result[0];
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && count($_POST) >= 2) {
  
  // validate the values
  $errors = [];

  // validate the product name
  if (!empty($_POST["name"]) && filter_input(INPUT_POST, "name")) {
    $name = $_POST["name"];
  } else {
    $errors["name"] = "Please enter a valid product Name";
  }

  // validatethe product description
  if (!empty($_POST["description"]) && filter_input(INPUT_POST, "description")) {
    $description = $_POST["description"];
  } else {
    $errors["description"] = "Please enter a valid product description";
  }

  // validate the product image
  if (isset($_FILES["image"]) && !$_FILES["image"]["error"] && str_contains($_FILES["image"]["type"], "image/")) {
    move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/../img/" . $_FILES["image"]["name"]);
    $image_url = "img/" . $_FILES["image"]["name"];
  } else {
    $errors["image"] = "Please enter a valid product image";
  }

  // validate the product price
  if (!empty($_POST["price"]) && filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT)) {
    $price = (float) $_POST["price"];
  } else {
    $errors["price"] = "Please enter a valid product price";
  }

  // validate the product Discount
  if (
    !empty($_POST["discount"]) && filter_input(INPUT_POST, "discount", FILTER_VALIDATE_FLOAT)
  ) {
    $discount = ((float) $_POST["discount"]) / 100;
  } else {
    $errors["discount"] = "Please enter a valid product discount";
  }

  // insert the values in the products table
  if (!$errors) {
    $bar_code = $_POST["bar-code"] ?? NULL;
    $size_id = (int) $_POST["size"];
    $color_id = (int) $_POST["color"];
    $category_id = (int) $_POST["category"];

    $is_recent = isset($_POST["is_recent"]) ? 1 : 0;
    $is_featured = isset($_POST["is_featured"]) ? 1 : 0;

    // Update the product here.
  } else {
    $oldValues = $_POST;
    $oldFiles = $_FILES;
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
      <h1 class="mb-3">Edit Product</h1>
      <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Product Name: </label>
          <input type="text" class="form-control" id="name" name="name" value="<?= !isset($errors["name"]) && isset($oldValues["name"]) ? $oldValues["name"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["name"]) ? $errors["name"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="category">Product Category: </label>
          <select class="form-control" id="category" name="category_i">
            <?php
            foreach ($categories as $category) {
            ?>
              <option value="<?= $category["id"] ?>" <?= (!isset($errors["category"]) && isset($oldValues["category_id"]) && $category["id"] == $oldValues["category_id"]) ? 'selected' : "" ?>><?= $category["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Product Description: </label>
          <textarea class="form-control" id="description" name="description"><?= !isset($errors["description"]) && isset($oldValues["description"]) ? $_POST["description"] : ""  ?></textarea>
          <span class="text-danger"><?= isset($errors["description"]) ? $errors["description"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="image">Product Image: </label>
          <input type="file" class="form-control-file" id="image" name="image">
          <span class="text-danger"><?= isset($errors["image"]) ? $errors["image"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="price">Product Price: </label>
          <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?= isset($errors["price"]) ? $_POST["price"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["price"]) ? $errors["price"] : ""  ?></span>
        </div>
        <div class="form-group">
          <label for="bar-code">Product Bar Code: </label>
          <input type="text" class="form-control" id="bar-code" name="bar-code">
        </div>
        <div class="form-group">
          <label for="color">Color</label>
          <select class="form-control" id="color" name="color">
            <?php
            foreach ($colors as $color) {
            ?>
              <option value="<?= $color["id"] ?>" <?= (isset($oldValues["color"]) && $color["id"] == $oldValues["color"]) ? 'selected' : "" ?>><?= $color["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="color">Size</label>
          <select class="form-control" id="color" name="size">
            <?php
            foreach ($sizes as $size) {
            ?>
              <option value="<?= $size["id"] ?>" <?= (isset($oldValues["size"]) && $size["id"] == $oldValues["size"]) ? 'selected' : "" ?>><?= $size["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="discount">Product Discount (0% - 100%): </label>
          <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" step="0.1" value="<?= isset($errors["discount"]) ? $_POST["discount"] : ""  ?>">
          <span class="text-danger"><?= isset($errors["discount"]) ? $errors["discount"] : ""  ?></span>
        </div>
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_recent" name="is_recent" <?= isset($oldValues["is_recent"]) ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_recent">Recent</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" <?= isset($oldValues["is_featured"]) ? 'checked' : '' ?>>
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