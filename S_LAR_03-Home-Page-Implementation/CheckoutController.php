<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    use \App\Traits\CartSummaryTrait;

    function index()
    {
        $cartProducts = Session::get('cart', []);
        $products = $this->mapSessionProducts($cartProducts);
        $subTotal = $this->calculateSubTotal($cartProducts);
        $shipping = $this->calculateShipping($cartProducts);
        $total = $this->calculateTotal($cartProducts);

        return view('shop.checkout', compact('products', 'subTotal', 'shipping', 'total'));
    }
}
