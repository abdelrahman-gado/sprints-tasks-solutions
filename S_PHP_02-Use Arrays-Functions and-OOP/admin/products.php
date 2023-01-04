<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../logic/products.php";
require_once __DIR__ . "/../layouts/stars.php";


$products = getProducts();

?>

<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5 d-flex d-flex justify-content-center mb-2">
    <div class="col-lg-3 d-none d-lg-block">
      <a class="btn btn-block btn-primary font-weight-bold py-3" href="./add-product.php">Add Product</a>
    </div>
  </div>
  <div class="row bg-secondary py-1 px-xl-5">
    <div class="col-lg d-none d-lg-block">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Color</th>
            <th scope="col">Size</th>
            <th scope="col">Discount %</th>
            <th scope="col">Price</th>
            <th scope="col">Rating</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($products as $product) {
          ?>
            <tr>
              <td class="align-middle"><img src="<?= "/../" . $product["image_url"] ?>" width="70px" height="70px" /></td>
              <td class="align-middle"><?= $product["name"] ?></td>
              <td class="align-middle"><?= $product["category_name"] ?></td>
              <td class="align-middle"><?= $product["color_name"] ?></td>
              <td class="align-middle"><?= $product["size_name"] ?></td>
              <td class="align-middle"><?= $product["discount"] * 100 ?>%</td>
              <td class="align-middle"><?= $product["price"] ?></td>
              <td class="align-middle"><?= getHTMLStars($product["rating"]) . " (" . number_format($product["rating"] ?? 0, 1) . ")" ?></td>
              <td>
                <form action="edit-product.php" method="POST">
                  <input type="text" name="id" value="<?= $product["id"] ?>" hidden>
                  <button type="submit" class="btn btn-primary font-weight-bold">Edit</button>
                  <form>
              </td>
              <td>
                <form action="delete-product.php" method="POST">
                  <input type="text" name="id" value="<?= $product["id"] ?>" hidden>
                  <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>


    </div>
  </div>
</div>


<?php
require_once __DIR__ . "/../layouts/footer.php";
?>