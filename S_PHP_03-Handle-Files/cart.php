<?php

require_once __DIR__ . "/logic/cart.php";


function getUrl($item, bool $decreased, bool $increased, bool $removed)
{
  return "cartline.php?" . http_build_query([
    "id" => $item["product"]["id"],
    "decreased" => $decreased,
    "increased" => $increased,
    "removed" => $removed
  ]);
}

$cartItems = getCart();
require_once __DIR__ . "/layouts/header.php";
?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="#">Home</a>
        <a class="breadcrumb-item text-dark" href="#">Shop</a>
        <span class="breadcrumb-item active">Shopping Cart</span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-lg-8 table-responsive mb-5">
      <table class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark">
          <tr>
            <th>Products</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody class="align-middle" id="products">
          <?php
          foreach ($cartItems as $item) {
            $finalPrice = getPriceAfterDiscount($item["product"]["price"], $item["product"]["discount"]);
          ?>
            <tr>
              <td class="align-middle">
                <img src="<?= $item["product"]["image_url"] ?>" alt="" style="width: 50px" />
              </td>
              <td class="align-middle">$<?= $finalPrice ?></td>
              <td class="align-middle">
                <div class="input-group quantity mx-auto" style="width: 100px">
                  <div class="input-group-btn">
                    <a type="button" class="decBtn btn btn-sm btn-primary btn-minus" href="<?= getUrl($item, true, false, false) ?>">
                      <i class="fa fa-minus"></i>
                    </a>
                  </div>
                  <input type="text" class="quantityVal form-control form-control-sm bg-secondary border-0 text-center" value="<?= $item["quantity"] ?>" disabled/>
                  <div class="input-group-btn">
                    <a type="button" class="incBtn btn btn-sm btn-primary btn-plus" href="<?= getUrl($item, false, true, false) ?>">
                      <i class="fa fa-plus"></i>
                    </a>
                  </div>
                </div>
              </td>
              <td class="align-middle">$<?= calculateTotalPerItem($finalPrice, $item["quantity"]) ?></td>
              <td class="align-middle">
                <a class="btn btn-sm btn-danger" href="<?= getUrl($item, false, false, true) ?>">
                  <i class="fa fa-times"></i>
                </a>
              </td>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
    <div class="col-lg-4">
      <form class="mb-30" action="">
        <div class="input-group">
          <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code" />
          <div class="input-group-append">
            <button class="btn btn-primary">Apply Coupon</button>
          </div>
        </div>
      </form>
      <h5 class="section-title position-relative text-uppercase mb-3">
        <span class="bg-secondary pr-3">Cart Summary</span>
      </h5>
      <div class="bg-light p-30 mb-5">
        <div class="border-bottom pb-2">
          <div class="d-flex justify-content-between mb-3">
            <h6>Subtotal</h6>
            <h6 id="sub-total">$<?= calculateCartSubTotal() ?></h6>
          </div>
          <div class="d-flex justify-content-between">
            <h6 class="font-weight-medium">Shipping</h6>
            <h6 class="font-weight-medium" id="shipping">$<?= calculateCartShipping() ?></h6>
          </div>
        </div>
        <div class="pt-2">
          <div class="d-flex justify-content-between mt-2">
            <h5>Total</h5>
            <h5 id="total">$<?= calculateCartTotal() ?></h5>
          </div>
          <a class="btn btn-block btn-primary font-weight-bold my-3 py-3" href="/checkout.php">
            Proceed To Checkout
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Cart End -->

<?php
require_once __DIR__ . "/layouts/footer.php";
?>