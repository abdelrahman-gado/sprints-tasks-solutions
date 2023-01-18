<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

trait CartSummaryTrait
{

  public function calculateSubTotal($cartProducts)
  {
    $subTotal = 0;
    foreach ($cartProducts as $id => $quantity) {
      $product = Product::findOrFail($id);
      $productPriceAfterDiscount = $product->getPriceAfterDiscount();
      $subTotal += ($productPriceAfterDiscount * $quantity);
    }

    return $subTotal;
  }

  public function calculateShipping($cartProducts)
  {
    $cartProducts = Session::get('cart', []);
    $totalProductCount = array_reduce($cartProducts, fn ($count, $quantity) => $count + $quantity, 0);
    return $totalProductCount * 2;
  }

  public function calculateTotal($cartProducts)
  {
    $total = $this->calculateSubTotal($cartProducts) + $this->calculateShipping($cartProducts);
    return $total;
  }


  public function mapSessionProducts($cartProducts)
  {
    $products = array_map(function ($id, $quantity) {
      $product = Product::findOrFail($id);
      return [
        "product" => $product,
        "quantity" => $quantity
      ];
    }, array_keys($cartProducts), array_values($cartProducts));

    return $products;
  }
}
