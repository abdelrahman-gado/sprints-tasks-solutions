<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    use \App\Traits\CartSummaryTrait;

    function index()
    {

        $cartProducts = Session::get('cart', []);
        $products = $this->mapSessionProducts($cartProducts);
        $subTotal = $this->calculateSubTotal($cartProducts);
        $shipping = $this->calculateShipping($cartProducts);
        $total = $this->calculateTotal($cartProducts);

        return view('shop.cart', compact('products', 'subTotal', 'shipping', 'total'));
    }


    function decreaseProductQuantity(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return abort(404);
        }

        $cartProducts = Session::get('cart', []);
        if (isset($cartProducts[$id]) && $cartProducts[$id] > 1) {
            $cartProducts[$id] -= 1;
        } else {
            return abort(404);
        }

        Session::put('cart', $cartProducts);
        return response()->json(["url" => url("/cart")]);
    }

    function increaseProductQuantity(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return abort(404);
        }

        $cartProducts = Session::get('cart', []);
        if (isset($cartProducts[$id])) {
            $cartProducts[$id] += 1;
        } else {
            return abort(404);
        }

        Session::put('cart', $cartProducts);
        return response()->json(["url" => url("/cart")]);
    }

    function removeProductFromCart(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return abort(404);
        }

        $cartProducts = Session::get('cart', []);
        unset($cartProducts[$id]);
        Session::put('cart', $cartProducts);
        return response()->json(["url" => url("/cart")]);
    }
}
