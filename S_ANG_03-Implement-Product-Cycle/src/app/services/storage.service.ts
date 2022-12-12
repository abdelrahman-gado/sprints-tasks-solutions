import { Injectable } from "@angular/core";
import { CartLine } from "../interfaces/cart-line";
import { Product } from "../interfaces/product";

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
      products.push({ product, quantity });
    }

    localStorage.setItem("products", JSON.stringify(products));
  }

  getCartLines(): CartLine[] {
    // Convert array of products into cart lines array and return it.

    const cartLines: CartLine[] = [];
    const products = this.getProductsFromLocalStorage();

    products.forEach((productObj: any) => {
      const currentCartLine: CartLine = {
        product: productObj.product,
        price: productObj.product.price,
        quantity: productObj.quantity,
      };
      cartLines.push(currentCartLine);
    });

    return cartLines;
  }
}
