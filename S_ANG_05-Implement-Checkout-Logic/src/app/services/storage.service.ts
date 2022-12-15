import { Injectable } from "@angular/core";
import { Cart } from "../classes/cart";
import { CartLine } from "../classes/cart-line";
import { Product } from "../classes/product";


@Injectable({
  providedIn: "root",
})
export class StorageService {
  constructor() {}

  getProductsFromLocalStorage() {
    return JSON.parse(localStorage.getItem("products") || "[]");
  }

  addProduct(product: Product, quantity: number) {
    // Add Product to localstorage as flat products (array of products not cartlines)
    const products = this.getProductsFromLocalStorage();
    const index = products.findIndex(
      (productObj: any) => productObj.product._id === product._id
    );

    // If the product already in the localstorage, just increase the quantity by quantity paramerter value.
    // Else create a new product in localstorage and set its quantity.
    if (index >= 0) {
      products[index].quantity += quantity;
    } else {
      products.push({ product, quantity, price: product.price });
    }

    localStorage.setItem("products", JSON.stringify(products));
  }

  getCartObject(): Cart {
    // Convert array of products into cart lines array and return it.
    const cartLines: CartLine[] = [];
    const products = this.getProductsFromLocalStorage();

    products.forEach((productObj: any) => {
      const currentCartLine: CartLine = new CartLine(
        productObj.product,
        productObj.quantity,
        productObj.price
      );
      cartLines.push(currentCartLine);
    });

    const CartObj = new Cart(cartLines);

    return CartObj;
  }

  save(cartLines: CartLine[]) {
    const products = cartLines.map((cartLine: CartLine) => {
      return {
        product: cartLine.product,
        quantity: cartLine.quantity,
        price: cartLine.price,
      };
    });

    localStorage.setItem("products", JSON.stringify(products));
  }

  getQuantity(): number {
    const products = this.getProductsFromLocalStorage();
    return products.reduce((totalQuantity: number, productObj: any) => {
      return (totalQuantity += productObj.quantity);
    }, 0);
  }
}
