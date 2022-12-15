import { StorageService } from "../services/storage.service";
import { CartLine } from "./cart-line";

export class Cart {
  cartList: CartLine[];
  private storageService: StorageService;

  constructor(cartList: CartLine[]) {
    this.cartList = cartList;
    this.storageService = new StorageService();
  }

  getSubTotal(): number {
    return this.cartList
      .map((cartLine) => cartLine.price * cartLine.quantity)
      .reduce((subTotal, cartLinePrice) => (subTotal += cartLinePrice));
  }

  getShipping(): number {
    return (
      this.cartList
        .map((line) => line.quantity)
        .reduce((subTotal, quantity) => (subTotal += quantity), 0) * 2
    );
  }

  getTotal(): number {
    return this.getSubTotal() + this.getShipping();
  }

  decQuantity(i: number): void {
    if (this.cartList[i].quantity > 1) {
      this.cartList[i].quantity -= 1;
    }

    this.storageService.save(this.cartList);
  }

  incQuantity(i: number): void {
    this.cartList[i].quantity += 1;
    this.storageService.save(this.cartList);
  }

  remove(i: number): void {
    this.cartList.splice(i, 1);
    this.storageService.save(this.cartList);
  }

}
