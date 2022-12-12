import { Component } from '@angular/core';
import { CartLine } from 'src/app/interfaces/cart-line';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: "app-cart",
  templateUrl: "./cart.component.html",
  styleUrls: ["./cart.component.css"],
})
export class CartComponent {
  cartLines: CartLine[] = [];

  constructor(private storageService: StorageService) {
    this.cartLines = this.storageService.getCartLines();
  }

  getSubTotal(): number {
    return this.cartLines
      .map((line) => line.price * line.quantity)
      .reduce((subTotal, t) => (subTotal += t), 0);
  }

  getShipping(): number {
    return (
      this.cartLines
        .map((line) => line.quantity)
        .reduce((subTotal, t) => (subTotal += t), 0) * 2
    );
  }

  getTotal(): number {
    return this.getSubTotal() + this.getShipping();
  }

  showAlert(msg: string) {
    alert(msg);
  }
}
