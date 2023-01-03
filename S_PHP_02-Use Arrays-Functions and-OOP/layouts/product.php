<?php
  require_once __DIR__ . "/stars.php";

?>


<?php
foreach ($products as $product) {

  // Depending on the type section display the product.
  // $sectionType is declare in the index.html in the section div of product.
  if (($product["is_featured"] && $sectionType === "featured") || ($product["is_recent"] && $sectionType === "recent")) {
?>
    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
      <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
          <img class="img-fluid w-100" src="<?= $product["image_url"] ?>" alt="">
          <div class="product-action">
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
          </div>
        </div>
        <div class="text-center py-4">
          <a class="h6 text-decoration-none text-truncate" href="product.php?id=<?= $product["id"] ?>"><?= $product["name"] ?></a>
          <div class="d-flex align-items-center justify-content-center mt-2">
            <h5>$<?= ($product["price"] - ($product["price"] * $product["discount"])) ?></h5>
            <h6 class="text-muted ml-2"><del>$<?= $product["price"] ?></del></h6>
          </div>
          <div class="d-flex align-items-center justify-content-center mb-1">
            <?php
              echo getHTMLStars($product["rating"]);
            ?>
            <small>(<?= $product["rating_count"] ?>)</small>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
?>