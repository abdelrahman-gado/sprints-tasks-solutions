<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../logic/products.php";


$colors = get_rows("SELECT * FROM colors");
$sizes = get_rows("SELECT * FROM sizes");
?>

<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5 d-flex d-flex justify-content-center mb-2">
    <div class="col-lg-8 d-none d-lg-block">
      <form enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Product Name: </label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
          <label for="description">Product Description: </label>
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Product Image: </label>
          <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
          <label for="price">Product Price: </label>
          <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
          <label for="color">Color</label>
          <select class="form-control" id="color" name="color">
            <?php
            foreach ($colors as $color) {
            ?>
              <option value="<?= $color["id"] ?>"><?= $color["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="color">Color</label>
          <select class="form-control" id="color" name="size">
            <?php
            foreach ($sizes as $size) {
            ?>
              <option value="<?= $size["id"] ?>"><?= $size["name"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="discount">Product Discount: </label>
          <input type="number" class="form-control" id="discount" name="discount">
        </div>
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_recent" name="is_recent" value="recent">
            <label class="form-check-label" for="is_recent">Recent</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="featured">
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